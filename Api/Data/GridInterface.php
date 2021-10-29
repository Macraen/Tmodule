<?php

namespace Macraen\Tmodule\Api\Data;

interface GridInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    const ENTITY_ID = 'id';
    const NAME = 'offline_customer_name';
    const EMAIL = 'offline_customer_email';
    const CREATION_DATE = 'creation_date';

   /**
    * Get EntityId.
    *
    * @return int
    */
    public function getEntityId();

   /**
    * Set EntityId.
    */
    public function setEntityId($entityId);

   /**
    * Get Name.
    *
    * @return varchar
    */
    public function getName();

   /**
    * Set Name.
    */
    public function setName($name);

   /**
    * Get Email.
    *
    * @return varchar
    */
    public function getEmail();

   /**
    * Set Email.
    */
    public function setEmail($email);


   /**
    * Get CreatedAt.
    *
    * @return varchar
    */
    public function getCreatedAt();

   /**
    * Set CreatedAt.
    */
    public function setCreatedAt($createdAt);
}
