<?php

class tipAFriendForm extends owForm
{
    function init()
    {
        $user = eZUser::currentUser();
        $ini = eZINI::instance();
        // Get name and email from current user, unless it is the anonymous user
        if ( is_object( $user ) && $user->id() != $ini->variable( 'UserSettings', 'AnonymousUserID' ) )
        {
            $userObject = $user->attribute( 'contentobject' );
            $default_name = $userObject->attribute( 'name' );
            $default_email = $user->attribute( 'email' );
        }

        $name = new owFormText(array('name' => 'name', 'label' => 'Your Name', 'default' => $default_name));
        $this->addFormElement($name);

        $sender_email = new owFormText(array('name' => 'sender_email', 'label' => 'Your email address', 'required' => true, 'default' => $default_email));
        $this->addFormElement($sender_email);

        $receivers_email = new owFormText(array('name' => 'receivers_email', 'label' => 'Receivers email address', 'required' => true));
        $this->addFormElement($receivers_email);

        $comment = new owFormTextarea(array('name' => 'comment', 'label' => 'Comment', 'cols' => 40, 'rows' => 10));
        $this->addFormElement($comment);

        /*$send = new owFormInputButton(array('name' => 'send', 'label' => 'Send'));
         $this->addFormElement($send);*/
    }

    function doProcess()
    {
        $submitted_data = $this->getSubmittedData();
        $NodeID = $this->getOption('node_id');
        $nodeName = $this->getOption('node_name');
        $hostName = eZSys::hostname();
        $subject = ezpI18n::tr( 'kernel/content', 'Tip from %1: %2', null, array( $hostName, $nodeName ) );
        $fromEmail = null;
        $ini = eZINI::instance();

        if ( $ini->hasVariable( 'TipAFriend', 'FromEmail' ) )
        {
            $fromEmail = $ini->variable( 'TipAFriend', 'FromEmail' );
            if ( $fromEmail != null )
            if ( !eZMail::validate( $fromEmail ) )
            {
                eZDebug::writeError( "The email < $fromEmail > specified in [TipAFriend].FromEmail setting in site.ini is not valid",'tipafriend' );
                $fromEmail = null;
            }
        }
        if ( $fromEmail == null )
        {
            $fromEmail = $submitted_data['sender_email']->getValue();
        }
    }

}

$http = eZHTTPTool::instance();
$NodeID = (int)$Params['NodeID'];
if ( $http->hasPostVariable( 'NodeID' ) )
$NodeID = (int)$http->variable( 'NodeID' );

$node = eZContentObjectTreeNode::fetch( $NodeID );
if ( is_object( $node ) )
{
    $nodeName = $node->getName();
}
else
{
    return $Module->handleError( eZError::KERNEL_NOT_AVAILABLE, 'kernel' );
}

$object = $node->object();
if ( !$object->canRead() )
{
    return $Module->handleError( eZError::KERNEL_ACCESS_DENIED, 'kernel', array( 'AccessList' => $object->accessList( 'read' ) ) );
}

$title = ezi18n( 'extension/owmoduleforms', 'Tip a friend' );
$tipAFriendForm = new tipAFriendForm(array('name' => 'sendtofriend', 'method' => 'post', 'title' => $title, 'module' => $Module, 'node_id' => $NodeID, 'node_name' => $nodeName));
$Module->setTitle($title);

$Result = array();
$Result['layout'] = false;
$Result['content'] = $tipAFriendForm->render();
$Result['path'] = array( array( 'url' => '/owmoduleformssamples/tipafriend/',
                                'text' =>  $title) );

?>