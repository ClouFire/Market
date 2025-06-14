<?php

namespace PHPFramework;

use Valitron\Validator;


abstract class Model
{
    protected string $table;
    protected bool $timestamps; 
    protected array $loaded = [];
    protected array $fillable = [];
    public array $attrs = [];
    protected array $rules = [];
    protected array $errors = [];

    public function save(): false|string
    {
        $fields = [];
        $placeholders = [];
        foreach($this->attrs as $attr => $value)
        {
            if(!in_array($attr, $this->fillable))
            {
                unset($this->attrs[$attr]);
            }
            else
            {
                $fields[] = "`{$attr}`";
                $placeholders[] = ":{$attr}";
            }
        }
        $fields = implode(',', $fields);
        $placeholders = implode(',', $placeholders);
        if($this->timestamps)
        {
            $this->attrs['created_at'] = date("Y-m-d H:i:s");
            $this->attrs['updated_at'] = date("Y-m-d H:i:s");
            $fields .= ',`created_at`,`updated_at`';
            $placeholders .= ',:created_at,:updated_at';
        }
        $query = "INSERT INTO {$this->table} ($fields) VALUES ($placeholders)";
        db()->execute($query, $this->attrs);
        $id = db()->getInsertId();
        db()->createCart($id);
        return $id;

    }
    public function loadData(): void
    {
        $data = request()->getData();
        foreach($this->loaded as $field)
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

    public function getProduct($id)
    {
        $data = db()->findOne('goods', $id);
        foreach($this->loaded as $field)
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
        Validator::langDir(WWW . '/lang');
        Validator::lang('en');
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

    public function addValidationRule(string $name, callable $function, string $message)
    {
        Validator::addRule("{$name}", function ($field, $value, array $params = [], array $fields = []) use ($function){
            return $function($field, $value, $params, $fields);
        }, $message);
    }
}