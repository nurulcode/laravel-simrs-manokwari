<?php

namespace Sty;

interface ResourceModel
{
    public function getPathAttribute();

    public function path($action = 'show');

    public function controller();

    public function policy();

    public function permissionKeyName();
}
