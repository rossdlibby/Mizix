<?php
class Magniloquent extends \Illuminate\Database\Eloquent {
    
    public function __construct($attributes = array()) {
        parent::__construct($attributes);
        $this->validationErrors = new \Illuminate\Support\MessageBag();
    }
    
    private function performSave(array $options = array())
    {
        static::$rules = $this->mergeRules();
        
        // If the validation failed, return false
        // 각 속성들에 대한 룰 인증
        if(!$this->validate($this->attributes)) return false;
        
        // Purge Redundent fields
        $this->attributes = $this->purgeRedundent($this->attributes);
        
        // Auto hash passwords
        // 자동 비밀번호 암호화.
        $this->attributes = $this->autoHash();
        
        return parent::save($options);
    }
    
    /**
     * Merge Rules
     * (검증 룰 병합)
     * 
     * Merge the rules arrays to form one set of rules
     * @return array()
     */
    private function mergeRules()
    {
        if($this->exists){
            $merged = array_merge_recursive(static::$rules['save'], static::$rules['update']);
        }else{
            $merged = array_merge_recursive(static::$rules['save'], static::$rules['create']);
        }
        foreach($merged as $field => $rules){
            if(is_array($rules)){
                $output[$field] = implode("|", $rules);
            }else{
                $output[$field] = $rules;
            }
        }
        return $output;
    }
    
    /**
     * Validate
     * (인증)
     *
     * Validate input against merged rules
     * @param array $attributes
     * @return boolean
     */
    private function validate($attributes)
    {
        $validation = Validator::make($attributes, static::$rules);

        if($validation->passes()) return true;

        $this->validationErrors = $validation->messages();
        
        
        return false;
    }
    
    /**
     * Purge Redundant fields
     * (중복 필드 제거)
     * 
     * Get rid of '_confirmation' fields
     * @param type $attributes
     * @return array
     */
    private function purgeRedundant($attributes)
    {
        foreach($attributes as $key => $value){
            if(!Str::endsWith( $key, '_confirmation')){
                $clean[$key] = $value;
            }
        }
        return $clean;
    }
    
    /**
     * Auto hash
     * (자동 암호화)
     * 
     * Auto hash passwords
     * @return array
     */
    private function autoHash()
    {
        if(isset($this->attributes['password']))
        {
            if($this->attributes['password'] != $this->getOriginal('password')){
                $this->attributes['password'] = Hash::make($this->attributes['password']);
            }
        }
        return $this->attributes;
    }
}

