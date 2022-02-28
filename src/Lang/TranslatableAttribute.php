<?php

namespace Macrame\Lang;

class TranslatableAttribute
{
    public function __construct(
        protected array $values,
        protected string $locale
    ) {
        //
    }

    public function value(): mixed
    {
        return $this->values[$this->locale] ?? null;
    }

    public function raw(): string
    {
        return json_encode($this->values);
    }

    public function __toString()
    {
        return $this->value();
    }
}
