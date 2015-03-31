<?php
/**
 * Created by PhpStorm.
 * User: sean
 * Date: 3/30/15
 * Time: 8:51 AM
 */

use \convercity\Helpers\Uploader;
class HelpersUploaderTest extends PHPUnit_Framework_TestCase {

    /**
     *
     * Tests if function cleans phone number of
     * any non numeric characters.
     *
     */
    public function testCleanPhoneNumberReturnsClean()
    {
        $dirty = 'Cell: +1 (55) 5/555-55.55';

        $clean = '15555555555';

        $test = Uploader::cleanPhoneNumber($dirty);

        $this->assertEquals($clean, $test);

    }

    /**
     *
     * function adds a leading 1 to phone numbers that
     * don't have one.
     *
     */
    public function testCleanPhoneNumberAddsLeading1()
    {
        $dirty = 555555555;
        $clean = 1555555555;

        $test = Uploader::cleanPhoneNumber($dirty);

        $this->assertEquals($clean, $test);
    }

}
