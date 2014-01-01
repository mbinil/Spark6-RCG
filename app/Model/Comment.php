<?php
class Comment extends AppModel
{
   /**
    * fetching the comments related to the conditions
    * @param array $conditions
    * @return array comments array
    */
   public function getComment($conditions)
   {
           return $this->find('all', array('fields'=>array('Comment.*,user.*'),
                           'joins' => array(
                                   array(
                                           'table' => 'users',
                                           'alias' => 'user',
                                           'type' => 'inner',
                                           'foreignKey' => false,
                                           'conditions'=> array('user.id = Comment.user_id')
                                   )
                           ),
                           'conditions' =>  $conditions,
                            'order'     =>  array('Comment.id DESC'),
                   )
           );
   }
   
   public function createComment($comment_array)
   {
       $full_url  =   Router::url('/', true);
       $html    =   '';
       if($comment_array)
       {
           foreach ($comment_array as $key => $value)
           {
               $html    .=   '<div id="comment_div_id_'.$value['Comment']['id'].'">
                                <div style="float:left; margin:0 10px 0 0"><img height="50" width="50" alt="image description" src="'.$full_url.'img/useruploads/'.$value['user']['user_profile_picture'].'"></div>
                                <div>'.$value['Comment']['comment'].'</div>
                                <div style="font-size:12px; margin-top:8px;">By '.ucfirst($value['user']['user_firstname']).' '.$value['user']['user_lastname'].'</div>
                            </div><div class="clear"></div><hr style="margin: 10px 0;"/>';
           }
       }
       
       return $html;
   }
   
   public function inserComment($login_user_id)
   {
        $insert_array['challenge_id']    =   $_POST['challenge_id'];
        $insert_array['user_id']         =   $login_user_id;
        $insert_array['comment']         =   $_POST['comment'];

        if($this->save($insert_array))
        {
            return 1;
        }
        else
        {
            return 0;
        }
   }
}
?>