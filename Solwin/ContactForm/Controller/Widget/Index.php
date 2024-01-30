<?php
namespace Solwin\ContactForm\Controller\Widget;

use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\StoreManagerInterface;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Solwin\ContactForm\Helper\Data
     */
    protected $_helper;

    protected $_pageFactory;

	protected $_postFactory;

    protected $transportBuilder;

    protected $storeManager;

    protected $inlineTranslation;

    public const EMAILTEMPLATE = 'solwincontact_section/contectemailsend/emailtemplate';

    public const EMAILSENDER = 'solwincontact_section/contectemailsend/contectemailsendto';

    public const SENDERNAME = 'solwincontact_section/contectemailsend/contectemailsender';

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Solwin\ContactForm\Helper\Data $helper,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
		\Solwin\ContactForm\Model\ContactWidgetFactory $postFactory,
        TransportBuilder $transportBuilder,
        StoreManagerInterface $storeManager,
        StateInterface $state
    ) {
        parent::__construct($context);
        $this->_helper = $helper;
        $this->_pageFactory = $pageFactory;
		$this->_postFactory = $postFactory;
        $this->transportBuilder = $transportBuilder;
        $this->storeManager = $storeManager;
        $this->inlineTranslation = $state;
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $post = $this->getRequest()->getParams();

        if($post){
            $resultRedirect = $this->resultRedirectFactory->create();

            /**Data save */
            $model = $this->_postFactory->create();
            $model->setData($post)->save();

            /**Email send */
            try{
                $templateId = $this->_helper->getConfigValue(self::EMAILTEMPLATE);
                $fromEmail = $this->_helper->getConfigValue(self::EMAILSENDER);  
                $fromName = $this->_helper->getConfigValue(self::SENDERNAME);          
                $toEmail = $post['email'];
    
                $redirectUrl = $post['currUrl'];
                try{
    
                $templateVars = [
                    'name' => isset($post['name']) ? $post['name'] : '',
                    'email' => isset($post['email']) ? $post['email'] : '',
                    'phone' => isset($post['phone_number']) ? $post['phone_number'] : '',
                    'subject' => isset($post['subject']) ? $post['subject'] : '',
                    'message' => isset($post['message']) ? $post['message'] : '',
                    'byregard' =>  $fromName 
                ];
     
                $storeId = $this->storeManager->getStore()->getId();
     
                $from = ['email' => $fromEmail, 'name' => $fromName];
                $this->inlineTranslation->suspend();
     
                $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
                $templateOptions = [
                    'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                    'store' => $storeId
                ];
                $transport = $this->transportBuilder->setTemplateIdentifier($templateId, $storeScope)
                    ->setTemplateOptions($templateOptions)
                    ->setTemplateVars($templateVars)
                    ->setFrom($from)
                    ->addTo($toEmail)
                    ->addBcc($fromEmail)
                    ->getTransport();
                $transport->sendMessage();
                $this->inlineTranslation->resume();

            }catch(\Exception $e){
                $this->inlineTranslation->resume();
                $this->messageManager->addExceptionMessage($e, __('Unable to send mail. Please try again later'));
            }
            
                $this->messageManager->addSuccessMessage(__('Message send successfully.'));
            }catch(\Exception $e){
                $this->inlineTranslation->resume();
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Contact.'));
            }
            return $resultRedirect->setUrl($redirectUrl);
        }
        return;
    }
        
}
