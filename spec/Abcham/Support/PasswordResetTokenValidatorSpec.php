<?php

namespace spec\Abcham\Support;

use Abcham\Support\PasswordResetTokenGenerator;
use Carbon\Carbon;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class PasswordResetTokenValidatorSpec
 * @package spec\Abcham\Support
 */
class PasswordResetTokenValidatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Abcham\Contracts\TokenValidator');
    }

    function it_validates_dates_of_expiration_valid()
    {
        $tokenGenerator = new PasswordResetTokenGenerator();
        $created_at = Carbon::now();
        $valid_until = $created_at->copy()->addDay();
        $token = $tokenGenerator->generate($created_at, $valid_until);
        $this->validate($token)->shouldReturn(true);
    }

    function it_validates_dates_of_expiration_expired()
    {
        $tokenGenerator = new PasswordResetTokenGenerator();
        $created_at = Carbon::now()->subDays(3);
        $valid_until = $created_at->copy()->addDay();
        $token = $tokenGenerator->generate($created_at, $valid_until);
        $this->validate($token)->shouldReturn(false);
    }
}
