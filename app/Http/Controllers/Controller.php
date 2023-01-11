<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected string $code;
    protected array $filters;
    protected array $filterEntities;

    public function getFilterEntities(): array
    {
        return $this->filterEntities;
    }

    public function setFilters(array $filters): void
    {
        $this->filters = $filters;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    protected function abortIf(bool $boolean, int $code = 404, string $message = '', array $headers = [])
    {
        abort_if($boolean, $code, $message, $headers);
    }
}
