<?php

namespace App\Bot\Interpreter;

use Illuminate\Support\Facades\Log;
use OpenDialogAi\ContextEngine\Facades\AttributeResolver;
use OpenDialogAi\Core\Conversation\Intent;
use OpenDialogAi\Core\Utterances\UtteranceInterface;
use OpenDialogAi\InterpreterEngine\BaseInterpreter;
use OpenDialogAi\InterpreterEngine\DialogFlow\DialogFlowClient;
use OpenDialogAi\InterpreterEngine\Interpreters\NoMatchIntent;

class DialogFlowInterpreter extends BaseInterpreter
{
    protected static $name = 'interpreter.core.dialog_flow';

    public function interpret(UtteranceInterface $utterance): array
    {
        $dfClient = new DialogFlowClient();
        $intent = $dfClient->detectIntent('opendialogtester-vbwobs', $utterance->getText(), null);

        Log::info(sprintf('got intent %s', $intent));

        if ($intent) {
            $response = Intent::createIntentWithConfidence('df_success', 1);
            $response->addAttribute(AttributeResolver::getAttributeFor('dialog_flow_message', $intent));

            return [$response];
        }

        return [new NoMatchIntent()];
    }
}
