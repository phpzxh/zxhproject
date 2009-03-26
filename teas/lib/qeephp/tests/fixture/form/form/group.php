<?php

class Form_Group extends QForm
{
    /**
     * @return Form_Group
     */
    static function createDirect()
    {
        $form = new Form_Group();
        $form->add(self::GROUP, 'userinfo', array(
            array(QForm::ELEMENT, 'username', array('_ui' => 'textbox', 'maxlength' => 15)),
            array(QForm::ELEMENT, 'password', array('_ui' => 'password', 'maxlength' => 20))
        ));

        $form->add(QForm::GROUP, 'profile')
             ->add(QForm::ELEMENT, 'address', array('_ui' => 'textbox', 'maxlength' => 80))
             ->add(QForm::ELEMENT, 'postcode', array('_ui' => 'textbox', 'maxlength' => 6));

        return $form;
    }

    /**
     * @return Form_Group
     */
    static function createFromConfig()
    {
        $form = new Form_Group();
        $form->loadFromConfigFile(dirname(__FILE__) . '/group_form.yaml', false);
        return $form;
    }

}

