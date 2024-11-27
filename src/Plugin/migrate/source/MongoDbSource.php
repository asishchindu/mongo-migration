<?php

namespace Drupal\mongo_migration\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SourcePluginBase;
use Iterator;
use MongoDB\Model\BSONArray;

/**
 * Source plugin for MongoDB data.
 *
 * @MigrateSource(
 *   id = "mongodb_source"
 * )
 */
class MongoDBSource extends SourcePluginBase {

  /**
   * Initializes the MongoDB client and fetches data.
   */
  public function initializeIterator(): Iterator {
    $client = \Drupal::service('mongodb.client_factory')->get('default');
    $collection = $client->selectCollection('migration_qed42', 'city');
    // Convert BSONDocument to array for each result.
    $results = $collection->find();
    foreach ($results as $document) {
      $data = $document->getArrayCopy();
      if (isset($data['loc']) && $data['loc'] instanceof BSONArray) {
        $data['loc'] = $data['loc']->getArrayCopy();
      }

      yield $data;
    }
  }

  
  /**
   * {@inheritdoc}
   */
  public function fields() {
    return [
      '_id' => $this->t('ID'),
      'city' => $this->t('City'),
      'loc' => $this->t('Location array [latitude, longitude]'),
      'pop' => $this->t('Population'),
      'state' => $this->t('State'),
    ];
  }


  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      '_id' => [
        'type' => 'string',
        'alias' => '_id',
      ],
    ];
  }

  public function __toString() {
    return 'mongodb_source';
  }
}
