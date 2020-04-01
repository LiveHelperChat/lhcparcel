<?php

class erLhcoreClassExtensionLhcparcel
{
    public function __construct()
    {

    }

    public function run()
    {
        $dispatcher = erLhcoreClassChatEventDispatcher::getInstance();
        $dispatcher->listen('chat.genericbot_event_handler', array($this,'genericHandlerEvent'));
    }

    public function genericHandlerEvent($params)
    {
        if ($params['render'] == 'parcel_search') {

            $validFormat = true;
            $parcelFound = true;

            // $params['payload']

            if ($validFormat === false) {
                $trigger = erLhcoreClassModelGenericBotTrigger::fetch($params['render_args']['format']);
                erLhcoreClassGenericBotWorkflow::processTrigger($params['chat'], $trigger, true, array());
                return;
            }

            // Execute your request here

            if ($parcelFound == true) {
                $trigger = erLhcoreClassModelGenericBotTrigger::fetch($params['render_args']['valid']);
                erLhcoreClassGenericBotWorkflow::processTrigger($params['chat'], $trigger, true, array('args' => array('replace_array' => array('{parcel_status}' => 'Your parcel location if found'))));
            } else {
                $trigger = erLhcoreClassModelGenericBotTrigger::fetch($params['render_args']['invalid']);
                erLhcoreClassGenericBotWorkflow::processTrigger($params['chat'], $trigger, true, array());
            }
        }
    }

    public function __get($var) {
        switch ($var) {

            default :
                ;
                break;
        }
    }
}