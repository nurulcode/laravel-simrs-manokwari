<?php

namespace Tests\Feature;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;

class KunjunganControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Kunjungan::class;
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

    /** @skip */
    public function user_can_delete_a_resource()
    {
        return false;
    }
}
