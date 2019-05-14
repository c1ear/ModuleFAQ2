<?php
namespace Storenameaslkd\ModuleCrud\Model;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
class Users implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var CustomerRepositoryInterface
     * */
    protected $customerRepository;
    protected $searchCriteriaBuilder;

    /**
     * @param CustomerRepositoryInterface $customerRepository
     * @param SearchCriteriaBuilder$ searchCriteriaBuilder
     * */
    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        SearchCriteriaBuilder$searchCriteriaBuilder
    )
    {
      $this->customerRepository  =$customerRepository;
      $this->searchCriteriaBuilder =$searchCriteriaBuilder;
    }


/*
* Option getter
* @return array
*/
public function toOptionArray()
{
    $arr=$this->toArray();
      $ret = [];

      foreach ($arr as $key=>$value)
      {
          $ret[] = [
              'value' =>$key,
          'label' => $value
        ];
      }

      return $ret;
    }

/*
* Get options in "key-value" format
* @return array
*/
public function toArray()
{

    $searchCriteria =$this->searchCriteriaBuilder->create();
      $customers   =$this->customerRepository->getList( $searchCriteria)->getItems();$customersList = array();
      foreach ( $customers as$customer)
      {

          $customersList[$customer->getId()] = ('ID: '. $customer->getId() . ' ' .$customer->getFirstname() . ' ' .$customer->getLastname());
      }

      return $customersList;
    }

}