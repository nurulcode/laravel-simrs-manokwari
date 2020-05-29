<?php

namespace Tests\Feature\Authorization;

use Tests\TestCase;
use Sty\Tests\ResourceViewTestCase;
use Sty\Tests\ResourceControllerTestCase;

class PermissionTest extends TestCase
{
    use ResourceControllerTestCase, ResourceViewTestCase;

    public function resource()
    {
        return \App\Models\Permission::class;
    }

    public function viewpath()
    {
        return url('permission');
    }

    /** @skip **/
    public function user_can_create_a_resource()
    {
        return false;
    }

    /** @skip **/
    public function user_can_not_post_empty_data()
    {
        return false;
    }

    /** @skip **/
    public function user_can_update_a_resource()
    {
        return false;
    }

    /** @skip */
    public function user_can_delete_a_resource()
    {
        return false;
    }
}
