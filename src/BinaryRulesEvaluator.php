<?php

namespace CoralMedia\BinaryRulesEvaluator;

final class BinaryRulesEvaluator
{
	private array $rulesTable = [];

    public function setRulesTable(array $rulesTable): self
	{
		$this->rulesTable = $rulesTable;
		return $this;
	}

	public function evaluate(array $input = [])
    {
        $validRuleSet = false;
        foreach ($this->rulesTable as $label => $ruleSet) {
            $validRuleSet = (in_array($input, $ruleSet));
            foreach ($ruleSet as $rules) {
                $ruleEval = [];
                foreach ($rules as $key => $value) {
                    if ($value !== null) {
                        $ruleEval[$key] = $value === $input[$key];
                    }
                }
                $validRuleSet = !in_array(false, $ruleEval);
                if ($validRuleSet === true) {
                    $validRuleSet = $label;
                    break;
                }
            }
            if ($validRuleSet !== false) {
                break;
            }
        }

        return $validRuleSet ?? false;
    }
}