<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Utility\Inflector;
use Cake\Routing\Router;

/**
 * Notes Controller
 *
 * @property \App\Model\Table\NotesTable $Notes
 *
 * @method \App\Model\Entity\Note[] paginate($object = null, array $settings = [])
 */
class NotesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'limit' => 25,
            'order' => [
                'Notes.modified' => 'desc'
            ],
            'contain' => ['Types']
        ];

        $notes = $this->paginate($this->Notes);

        $this->set(compact('notes'));
        $this->set('_serialize', ['notes']);
    }

    /**
     * View method
     *
     * @param string|null $id Note id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null, $slug)
    {
        $note = $this->Notes->get($id, [
            'contain' => ['Types']
        ]);
        if (!is_null($note)) {
            $note->hit += 1;
            $this->Notes->save($note);
        }
        $this->set('note', $note);
        $this->set('_serialize', ['note']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $note = $this->Notes->newEntity();
        if ($this->request->is('post')) {

            $this->request->data['slug'] = Inflector::slug($this->request->data['title']);
            if($this->request->data['imagen']['name'] != ""){
                $folder = "files/notes/";
                $file = sha1(md5($this->request->data['title']));
                $picture = $file . substr($this->request->data['imagen']['name'], -4);
                $this->request->data['file'] = $picture;
            }

            $note = $this->Notes->patchEntity($note, $this->request->getData());
            
            if ($row = $this->Notes->save($note)) {
                if($this->request->data['imagen']['name'] != ""){
                    $folder .= $row['id'];
                    $this->Notes->updateAll(['path' => $folder . DS], ['id' => $row['id']]);
                    $dir = new Folder(WWW_ROOT . $folder, true, 0775);
                    $this->moveuploadfile($this->request->data['imagen']["tmp_name"], $folder . DS . $picture);
                }

                $this->Flash->success(__('The note has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The note could not be saved. Please, try again.'));
        }
        $types = $this->Notes->Types->find('list', ['order' => ['Types.name' => 'ASC']]);
        $this->set(compact('note', 'types'));
        $this->set('_serialize', ['note']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Note id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $slug)
    {
        $note = $this->Notes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $this->request->data['slug'] = Inflector::slug($this->request->data['title']);
            if($this->request->data['imagen']['name'] != ""){
                $folder = "files/notes/" . $id;
                $file = sha1(md5($this->request->data['title']));
                $picture = $file . substr($this->request->data['imagen']['name'], -4);
                $this->request->data['path'] = $folder . DS;
                $this->request->data['file'] = $picture;
            }

            $note = $this->Notes->patchEntity($note, $this->request->getData());
            if ($this->Notes->save($note)) {
                if($this->request->data['imagen']['name'] != ""){
                    $dir = new Folder(WWW_ROOT . $folder, true, 0775);
                    $this->moveuploadfile($this->request->data['imagen']["tmp_name"], $folder . DS . $picture);
                }
                $this->Flash->success(__('The note has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The note could not be saved. Please, try again.'));
        }
        $types = $this->Notes->Types->find('list', ['order' => ['Types.name' => 'ASC']]);
        $this->set(compact('note', 'types'));
        $this->set('_serialize', ['note']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Note id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $note = $this->Notes->get($id);
        if ($this->Notes->delete($note)) {
            $this->Flash->success(__('The note has been deleted.'));
        } else {
            $this->Flash->error(__('The note could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Home method
     *
     * @return \Cake\Http\Response|void
     */
    public function home()
    {
        $this->paginate = [
            'limit' => 10,
            'order' => [
                'Notes.hit' => 'desc'
            ],
            'contain' => ['Types']
        ];

        $notes = null;
        $word = null;

        if (isset($this->request->query['word']) and $this->request->query['word'] != '') {
            $word = $this->request->query['word'];
            $w = '%'.$word.'%';
            $notes = $this->paginate(
                $this->Notes->find('all')
                    ->where(['OR' => ['Notes.title ILIKE' => $w, 'Notes.keyword ILIKE' => $w]])
            );
        }

        $this->set(compact('notes', 'word'));
        $this->set('_serialize', ['notes']);
    }

    public function bearout()
    {
        if ($this->request->is('post')) {
            $key = Configure::read('KEYWORD');
            if ($key == $this->request->data['keyword']) {
                return $this->redirect(['action' => 'view', $this->request->data['id'], $this->request->data['slug']]);
            }
        } 
        $this->Flash->error(__('I can not visualize, try again.'));
        return $this->redirect($this->request->data['page']);
    }

    public function setrating()
    {
        if ($this->request->is('post')) {
            $note = $this->Notes->get($this->request->data['id']);
            if (!is_null($note)) {
                $note->rating = $this->request->data['rating'];
                $this->Notes->save($note);
                $this->Flash->success(__('The rating of note has been updated.'));
            } else {
                $this->Flash->error(__('The rating of note could not be updated. Please, try again.'));    
            }
        } 

        return $this->redirect($this->request->data['page']);
    }

    private function moveuploadfile($nameFile, $dest)
    {
        $file = new File($nameFile, true, 0664);
        $file->copy(WWW_ROOT . $dest);
        $file->close();
    }
}
