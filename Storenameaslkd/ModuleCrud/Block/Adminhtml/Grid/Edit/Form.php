<?php

namespace Storenameaslkd\ModuleCrud\Block\Adminhtml\Grid\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    protected $_systemStore;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Storenameaslkd\ModuleCrud\Model\Status $options,
        \Storenameaslkd\ModuleCrud\Model\Users $customersList,
        array $data = []
    ) {
        $this->_ret = $customersList;
        $this->_options = $options;
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }


    protected function _prepareForm()
    {
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $model = $this->_coreRegistry->registry('row_data');
        $form = $this->_formFactory->create(
            ['data' => [
                'id' => 'edit_form',
                'enctype' => 'multipart/form-data',
                'action' => $this->getData('action'),
                'method' => 'post'
            ]
            ]
        );
        $form->setHtmlIdPrefix('wkgrid_');
        if ($model->getPostId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Row Data'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('post_id', 'hidden', ['name' => 'post_id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Row Data'), 'class' => 'fieldset-wide']
            );
        }

        $wysiwygConfig = $this->_wysiwygConfig->getConfig(['tab_id' => $this->getTabId()]);

        $fieldset->addField(
            'name',
            'select',
            [
                'name' => 'name',
                'label' => __('Пользователи'),
                'id' => 'name',
                'title' => __('Пользователи'),
                'values' => $this->_ret->toOptionArray(),
                'class' => 'name',
            ]
        );

        $fieldset->addField(
            'tags',
            'editor',
            [
                'name' => 'tags',
                'label' => __('Вопрос'),
                'style' => 'height:2em;',
                'required' => true,
                'config' => $wysiwygConfig
            ]
        );
        $fieldset->addField(
            'post_content',
            'editor',
            [
                'name' => 'post_content',
                'label' => __('Ответ'),
                'style' => 'height:6em;',
                'required' => true,
                'config' => $wysiwygConfig
            ]
        );


       $fieldset->addField(
            'status',
            'select',
            [
                'name' => 'status',
                'label' => __('Статус'),
                'id' => 'status',
                'title' => __('Статус'),
                'values' => $this->_options->getOptionArray(),
                'class' => 'status',
                'required' => true,
            ]
        );
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}