<?php



use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\CreatesApplication;
use Tests\TestsHelper;

class FeatureTestCase extends \Laravel\BrowserKitTesting\TestCase
{
    use DatabaseTransactions;
    use CreatesApplication;
    use TestsHelper;

    public function seeErrors(array $fields)
    {
        foreach ($fields as $name => $errors) {
            foreach ((array) $errors as $message) {
                $this->seeInElement(
                    "#field_{$name}.has-error .help-block", $message
                );
            }
        }
    }
}