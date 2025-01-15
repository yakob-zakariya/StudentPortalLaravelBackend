<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class UniqueCompositeKey implements ValidationRule
{
    protected string $table;
    protected array $attributes;
    protected  $ignoreId = null;

    public function __construct(string $table, array $attributes, $ignoreId = null)
    {
        $this->table = $table;
        $this->attributes = $attributes;
        $this->ignoreId = $ignoreId;

        // dd($this->ignoreId);
    }
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $this->attributes[$attribute] = $value;

        $query = DB::table($this->table)
            ->where($this->attributes);

        if ($this->ignoreId) {
            $query->where('id', '<>', $this->ignoreId);
        }

        $exists = $query->exists();
        // dd($exists);

        if ($exists) {
            $fail("The $attribute has already been taken!!");
        }
    }
}
