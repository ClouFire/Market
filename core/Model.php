<?php

namespace PHPFramework;

use Valitron\Validator;


class Model
{
    protected array $fillable = [];
    public array $attrs = [];
    protected array $rules = [];
    protected array $errors = [];

    public function loadData(): void
    {
        $data = request()->getData();
        foreach($this->fillable as $field)
        {
            if(isset($data[$field]))
            {
                $this->attrs[$field] = $data[$field];
            }
            else
            {
                $this->attrs[$field] = '';
            }
        }
    }

    public function validate($data = [], $rules = [])
    {
        if(!$data)
        {
            $data = $this->attrs;
        }
        if (!$rules)
        {
            $rules = $this->rules;
        }

        $validator = new Validator($data);
        $validator->rules($rules);
        if($validator->validate())
        {
            return true;
        }
        else
        {
            $this->errors = $validator->errors();           
            return false;
        }
        
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}