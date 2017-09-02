<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Validator;
use DB;
use App\Exceptions\ModelValidationException;
use Illuminate\Foundation\Auth\User as Authenticatable;


class BaseModel extends Authenticatable
{

    protected static $validationMessages = [
        'required' => ':attribute is required',
        'email' => ':attribute must be valid'
    ];


    public function validate($validator) {
        // subclass can define this to run custom validations beyond the normal rules
    }


    protected function scopeUniqueRule($rules)
    {
        foreach ($rules as $field => &$ruleset) {
            $ruleset = is_string($ruleset) ? explode('|', $ruleset) : $ruleset;

            foreach ($ruleset as &$rule) {
                if (starts_with($rule, 'unique:') || $rule === 'unique') {
                    $rule = $this->prepareUniqueRule($rule, $field);
                }
            }
        }

        return $rules;
    }

    protected function prepareUniqueRule($rule, $field) {
        $parameters = explode(',', substr($rule, 7));

        // If the table name isn't set, get it.
        if (empty($parameters[0])) {
            $parameters[0] = $this->getModel()->getTable();
        }

        // If the field name isn't get, infer it.
        if (! isset($parameters[1])) {
            $parameters[1] = $field;
        }

        if ($this->exists) {
            // If the identifier isn't set, add it.
            if (! isset($parameters[2]) || strtolower($parameters[2]) === 'null') {
                $parameters[2] = $this->getModel()->getKey();
            }

            // Add the primary key if it isn't set in case it isn't id.
            if (! isset($parameters[3])) {
                $parameters[3] = $this->getModel()->getKeyName();
            }
        }

        return 'unique:' . implode(',', $parameters);
    }
    public function setErrors($errors) {
        $this->errors = $errors;
    }
    protected function performValidation() {
        $validator = Validator::make(
            $this->attributes,
            $this->scopeUniqueRule(static::$rules),
            static::$validationMessages
        );
        $validator->after([$this, 'validate']);

        if($validator->passes()) {
            return true;
        }

        $this->setErrors($validator->messages());
        return false;
    }

    protected function throwValidationException() {
        throw new ModelValidationException($this, $this->getErrors());
    }

    public function isValid() {
        return $this->performValidation();
    }

    public function isInvalid() {
        return !$this->isValid();
    }
}
