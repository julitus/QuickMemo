<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Notes Model
 *
 * @property \App\Model\Table\TypesTable|\Cake\ORM\Association\BelongsTo $Types
 *
 * @method \App\Model\Entity\Note get($primaryKey, $options = [])
 * @method \App\Model\Entity\Note newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Note[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Note|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Note patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Note[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Note findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class NotesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('notes');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Types', [
            'foreignKey' => 'type_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('title')
            ->notEmpty('title', 'Este campo no puede estar vacio');

        $validator
            ->scalar('keyword')
            ->notEmpty('keyword', 'Este campo no puede estar vacio');

        $validator
            ->scalar('file')
            ->allowEmpty('file');

        $validator
            ->scalar('path')
            ->allowEmpty('path');

        $validator
            ->scalar('slug')
            ->allowEmpty('slug');

        $validator
            ->allowEmpty('hit');

        $validator
            ->integer('rating')
            ->allowEmpty('rating');

        $validator
            ->scalar('content')
            ->allowEmpty('content');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['type_id'], 'Types'));

        return $rules;
    }
}
