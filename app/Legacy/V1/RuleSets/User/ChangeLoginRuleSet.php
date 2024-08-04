<?php

namespace App\Legacy\V1\RuleSets\User;

use App\Contracts\Http\RuleSet;
use App\Legacy\V1\Contracts\Http\Requests\RequestAttribute;
use App\Rules\CurrentPasswordRule;
use App\Rules\PasswordRule;
use App\Rules\UsernameRule;

/**
 * Rules applied when changing username/password.
 */
class ChangeLoginRuleSet implements RuleSet
{
	public static function rules(): array
	{
		return [
			RequestAttribute::USERNAME_ATTRIBUTE => ['sometimes', new UsernameRule(true)],
			RequestAttribute::PASSWORD_ATTRIBUTE => ['required', new PasswordRule(false)],
			RequestAttribute::OLD_PASSWORD_ATTRIBUTE => ['required', new PasswordRule(false), new CurrentPasswordRule()],
		];
	}
}
