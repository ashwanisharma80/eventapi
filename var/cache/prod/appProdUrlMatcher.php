<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/answer')) {
            // answer_index
            if (rtrim($pathinfo, '/') === '/answer') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_answer_index;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'answer_index');
                }

                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\AnswerController::indexAction',  '_route' => 'answer_index',);
            }
            not_answer_index:

            // answer_new
            if ($pathinfo === '/answer/new') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_answer_new;
                }

                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\AnswerController::newAction',  '_route' => 'answer_new',);
            }
            not_answer_new:

            // answer_show
            if (preg_match('#^/answer/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_answer_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'answer_show')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\AnswerController::showAction',));
            }
            not_answer_show:

            // answer_edit
            if (preg_match('#^/answer/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_answer_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'answer_edit')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\AnswerController::editAction',));
            }
            not_answer_edit:

            // answer_delete
            if (preg_match('#^/answer/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_answer_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'answer_delete')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\AnswerController::deleteAction',));
            }
            not_answer_delete:

        }

        if (0 === strpos($pathinfo, '/category')) {
            // category_index
            if (rtrim($pathinfo, '/') === '/category') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_category_index;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'category_index');
                }

                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\CategoryController::indexAction',  '_route' => 'category_index',);
            }
            not_category_index:

            // category_new
            if ($pathinfo === '/category/new') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_category_new;
                }

                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\CategoryController::newAction',  '_route' => 'category_new',);
            }
            not_category_new:

            // category_show
            if (preg_match('#^/category/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_category_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'category_show')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\CategoryController::showAction',));
            }
            not_category_show:

            // category_edit
            if (preg_match('#^/category/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_category_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'category_edit')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\CategoryController::editAction',));
            }
            not_category_edit:

            // category_delete
            if (preg_match('#^/category/(?P<id>[^/]++)/remove$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_category_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'category_delete')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\CategoryController::deleteAction',));
            }
            not_category_delete:

        }

        // droidinfotech_droid_default_index
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'droidinfotech_droid_default_index');
            }

            return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\DefaultController::indexAction',  '_route' => 'droidinfotech_droid_default_index',);
        }

        // home_page
        if ($pathinfo === '/home') {
            return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\DefaultController::homeAction',  '_route' => 'home_page',);
        }

        // dashboard_page
        if ($pathinfo === '/dashboard') {
            return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\DefaultController::dashboardAction',  '_route' => 'dashboard_page',);
        }

        // forgot_page
        if ($pathinfo === '/forgotpassword') {
            return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\DefaultController::forgotAction',  '_route' => 'forgot_page',);
        }

        if (0 === strpos($pathinfo, '/device')) {
            // device_index
            if (rtrim($pathinfo, '/') === '/device') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_device_index;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'device_index');
                }

                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\DeviceController::indexAction',  '_route' => 'device_index',);
            }
            not_device_index:

            // device_new
            if ($pathinfo === '/device/new') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_device_new;
                }

                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\DeviceController::newAction',  '_route' => 'device_new',);
            }
            not_device_new:

            // device_show
            if (preg_match('#^/device/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_device_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'device_show')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\DeviceController::showAction',));
            }
            not_device_show:

            // device_edit
            if (preg_match('#^/device/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_device_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'device_edit')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\DeviceController::editAction',));
            }
            not_device_edit:

            // device_delete
            if (preg_match('#^/device/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_device_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'device_delete')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\DeviceController::deleteAction',));
            }
            not_device_delete:

        }

        if (0 === strpos($pathinfo, '/e')) {
            if (0 === strpos($pathinfo, '/events')) {
                // events_index
                if (rtrim($pathinfo, '/') === '/events') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_events_index;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'events_index');
                    }

                    return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\EventsController::indexAction',  '_route' => 'events_index',);
                }
                not_events_index:

                // events_new
                if ($pathinfo === '/events/new') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_events_new;
                    }

                    return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\EventsController::newAction',  '_route' => 'events_new',);
                }
                not_events_new:

                // events_edit
                if (preg_match('#^/events/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_events_edit;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'events_edit')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\EventsController::editAction',));
                }
                not_events_edit:

                // events_delete
                if (0 === strpos($pathinfo, '/events/delete') && preg_match('#^/events/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_events_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'events_delete')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\EventsController::deleteAction',));
                }
                not_events_delete:

                if (0 === strpos($pathinfo, '/events/events')) {
                    // eventslogo_delete
                    if (0 === strpos($pathinfo, '/events/events/logo_delete') && preg_match('#^/events/events/logo_delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_eventslogo_delete;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'eventslogo_delete')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\EventsController::eventlogoRemoveAction',));
                    }
                    not_eventslogo_delete:

                    // eventsimage_delete
                    if (0 === strpos($pathinfo, '/events/events/images_delete') && preg_match('#^/events/events/images_delete/(?P<EventImages>[^/]++)/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_eventsimage_delete;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'eventsimage_delete')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\EventsController::eventimagesRemoveAction',));
                    }
                    not_eventsimage_delete:

                }

            }

            if (0 === strpos($pathinfo, '/exhibitor')) {
                // exhibitor_index
                if (rtrim($pathinfo, '/') === '/exhibitor') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_exhibitor_index;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'exhibitor_index');
                    }

                    return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\ExhibitorController::indexAction',  '_route' => 'exhibitor_index',);
                }
                not_exhibitor_index:

                // exhibitor_new
                if ($pathinfo === '/exhibitor/new') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_exhibitor_new;
                    }

                    return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\ExhibitorController::newAction',  '_route' => 'exhibitor_new',);
                }
                not_exhibitor_new:

                // exhibitor_edit
                if (preg_match('#^/exhibitor/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_exhibitor_edit;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'exhibitor_edit')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\ExhibitorController::editAction',));
                }
                not_exhibitor_edit:

                // exhibitor_delete
                if (0 === strpos($pathinfo, '/exhibitor/delete') && preg_match('#^/exhibitor/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_exhibitor_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'exhibitor_delete')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\ExhibitorController::deleteAction',));
                }
                not_exhibitor_delete:

            }

        }

        if (0 === strpos($pathinfo, '/maps')) {
            // maps_index
            if (rtrim($pathinfo, '/') === '/maps') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_maps_index;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'maps_index');
                }

                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\MapsController::indexAction',  '_route' => 'maps_index',);
            }
            not_maps_index:

            // maps_new
            if ($pathinfo === '/maps/new') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_maps_new;
                }

                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\MapsController::newAction',  '_route' => 'maps_new',);
            }
            not_maps_new:

            // maps_edit
            if (preg_match('#^/maps/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_maps_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'maps_edit')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\MapsController::editAction',));
            }
            not_maps_edit:

            // maps_delete
            if (preg_match('#^/maps/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_maps_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'maps_delete')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\MapsController::deleteAction',));
            }
            not_maps_delete:

        }

        if (0 === strpos($pathinfo, '/notification_message')) {
            // notification_message_index
            if (rtrim($pathinfo, '/') === '/notification_message') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_notification_message_index;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'notification_message_index');
                }

                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\Notification_messageController::indexAction',  '_route' => 'notification_message_index',);
            }
            not_notification_message_index:

            // notification_message_new
            if ($pathinfo === '/notification_message/new') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_notification_message_new;
                }

                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\Notification_messageController::newAction',  '_route' => 'notification_message_new',);
            }
            not_notification_message_new:

            // notification_message_show
            if (preg_match('#^/notification_message/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_notification_message_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'notification_message_show')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\Notification_messageController::showAction',));
            }
            not_notification_message_show:

            // notification_message_edit
            if (preg_match('#^/notification_message/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_notification_message_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'notification_message_edit')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\Notification_messageController::editAction',));
            }
            not_notification_message_edit:

            // notification_message_delete
            if (0 === strpos($pathinfo, '/notification_message/delete') && preg_match('#^/notification_message/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_notification_message_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'notification_message_delete')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\Notification_messageController::deleteAction',));
            }
            not_notification_message_delete:

            // notification_message_send
            if (preg_match('#^/notification_message/(?P<id>[^/]++)/send$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_notification_message_send;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'notification_message_send')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\Notification_messageController::sendMessageAction',));
            }
            not_notification_message_send:

        }

        if (0 === strpos($pathinfo, '/question')) {
            // question_index
            if (rtrim($pathinfo, '/') === '/question') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_question_index;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'question_index');
                }

                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\QuestionController::indexAction',  '_route' => 'question_index',);
            }
            not_question_index:

            // question_new
            if ($pathinfo === '/question/new') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_question_new;
                }

                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\QuestionController::newAction',  '_route' => 'question_new',);
            }
            not_question_new:

            // question_edit
            if (preg_match('#^/question/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_question_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'question_edit')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\QuestionController::editAction',));
            }
            not_question_edit:

            // question_delete
            if (preg_match('#^/question/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_question_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'question_delete')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\QuestionController::deleteAction',));
            }
            not_question_delete:

            // question_answer_delete
            if (0 === strpos($pathinfo, '/question/deletequestion') && preg_match('#^/question/deletequestion/(?P<questionId>[^/]++)/answer$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_question_answer_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'question_answer_delete')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\QuestionController::removeSurveyQuestionAction',));
            }
            not_question_answer_delete:

        }

        if (0 === strpos($pathinfo, '/survey')) {
            // survey_index
            if (rtrim($pathinfo, '/') === '/survey') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_survey_index;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'survey_index');
                }

                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\SurveyController::indexAction',  '_route' => 'survey_index',);
            }
            not_survey_index:

            // survey_new
            if ($pathinfo === '/survey/new') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_survey_new;
                }

                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\SurveyController::newAction',  '_route' => 'survey_new',);
            }
            not_survey_new:

            // user_app
            if ($pathinfo === '/survey/userapp') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_user_app;
                }

                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\SurveyController::userappAction',  '_route' => 'user_app',);
            }
            not_user_app:

            // survey_edit
            if (preg_match('#^/survey/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_survey_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'survey_edit')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\SurveyController::editAction',));
            }
            not_survey_edit:

            // survey_delete
            if (preg_match('#^/survey/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_survey_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'survey_delete')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\SurveyController::deleteAction',));
            }
            not_survey_delete:

            // mobile_survey
            if (0 === strpos($pathinfo, '/survey/mobilesurvey') && preg_match('#^/survey/mobilesurvey/(?P<survey_id>[^/]++)/(?P<token>[^/]++)(?:/(?P<offset>[^/]++))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_mobile_survey;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'mobile_survey')), array (  'offset' => 0,  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\SurveyController::mobileSurveyAction',));
            }
            not_mobile_survey:

            // intro_survey
            if (0 === strpos($pathinfo, '/survey/intro') && preg_match('#^/survey/intro/(?P<token>[^/]++)/(?P<eventId>[^/]++)(?:/(?P<offset>[^/]++))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_intro_survey;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'intro_survey')), array (  'offset' => 0,  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\SurveyController::introSurveyAction',));
            }
            not_intro_survey:

            // attempted_survey
            if ($pathinfo === '/survey/attempted') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_attempted_survey;
                }

                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\SurveyController::CheckAttemptedSurveyAction',  '_route' => 'attempted_survey',);
            }
            not_attempted_survey:

            if (0 === strpos($pathinfo, '/survey/results')) {
                // suvey_export_results
                if (0 === strpos($pathinfo, '/survey/results/export') && preg_match('#^/survey/results/export(?:\\.(?P<_format>csv|xls|xlsx))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_suvey_export_results;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'suvey_export_results')), array (  '_format' => 'xls',  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\SurveyController::resultsexportAction',));
                }
                not_suvey_export_results:

                // survey_results
                if ($pathinfo === '/survey/results') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_survey_results;
                    }

                    return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\SurveyController::resultsAction',  '_route' => 'survey_results',);
                }
                not_survey_results:

            }

        }

        if (0 === strpos($pathinfo, '/user')) {
            // user_index
            if (rtrim($pathinfo, '/') === '/user') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_user_index;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'user_index');
                }

                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\UserController::indexAction',  '_route' => 'user_index',);
            }
            not_user_index:

            // user_new
            if ($pathinfo === '/user/new') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_user_new;
                }

                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\UserController::newAction',  '_route' => 'user_new',);
            }
            not_user_new:

            // user_edit
            if (preg_match('#^/user/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_user_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_edit')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\UserController::editAction',));
            }
            not_user_edit:

            // user_delete
            if (preg_match('#^/user/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_user_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_delete')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\UserController::deleteAction',));
            }
            not_user_delete:

            if (0 === strpos($pathinfo, '/userfavourite')) {
                // userfavourite_index
                if (rtrim($pathinfo, '/') === '/userfavourite') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_userfavourite_index;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'userfavourite_index');
                    }

                    return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\UserFavouriteController::indexAction',  '_route' => 'userfavourite_index',);
                }
                not_userfavourite_index:

                // userfavourite_new
                if ($pathinfo === '/userfavourite/new') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_userfavourite_new;
                    }

                    return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\UserFavouriteController::newAction',  '_route' => 'userfavourite_new',);
                }
                not_userfavourite_new:

                // userfavourite_show
                if (preg_match('#^/userfavourite/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_userfavourite_show;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'userfavourite_show')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\UserFavouriteController::showAction',));
                }
                not_userfavourite_show:

                // userfavourite_edit
                if (preg_match('#^/userfavourite/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_userfavourite_edit;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'userfavourite_edit')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\UserFavouriteController::editAction',));
                }
                not_userfavourite_edit:

                // userfavourite_delete
                if (preg_match('#^/userfavourite/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'DELETE') {
                        $allow[] = 'DELETE';
                        goto not_userfavourite_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'userfavourite_delete')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\UserFavouriteController::deleteAction',));
                }
                not_userfavourite_delete:

            }

        }

        if (0 === strpos($pathinfo, '/log')) {
            if (0 === strpos($pathinfo, '/login')) {
                // check_path
                if ($pathinfo === '/login') {
                    return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\DefaultController::indexAction',  '_route' => 'check_path',);
                }

                // login_check
                if ($pathinfo === '/login_check') {
                    return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\DefaultController::loginAction',  '_route' => 'login_check',);
                }

            }

            // logout_check
            if ($pathinfo === '/logout') {
                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\DefaultController::logoutAction',  '_route' => 'logout_check',);
            }

        }

        // homepage
        if ($pathinfo === '/APP') {
            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',  '_route' => 'homepage',);
        }

        if (0 === strpos($pathinfo, '/webservice')) {
            if (0 === strpos($pathinfo, '/webservice/log')) {
                // user_login
                if ($pathinfo === '/webservice/login') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_user_login;
                    }

                    return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\UserController::loginAction',  '_route' => 'user_login',);
                }
                not_user_login:

                // user_logout
                if ($pathinfo === '/webservice/logout') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_user_logout;
                    }

                    return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\UserController::logoutAction',  '_route' => 'user_logout',);
                }
                not_user_logout:

            }

            // user_register
            if ($pathinfo === '/webservice/signup') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'OPTIONS', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'OPTIONS', 'HEAD'));
                    goto not_user_register;
                }

                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\UserController::signupAction',  '_route' => 'user_register',);
            }
            not_user_register:

            // user_forgotpassword
            if ($pathinfo === '/webservice/forgotpassword') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_user_forgotpassword;
                }

                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\UserController::forgotAction',  '_route' => 'user_forgotpassword',);
            }
            not_user_forgotpassword:

            // user_changepassword
            if ($pathinfo === '/webservice/changepassword') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_user_changepassword;
                }

                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\UserController::changepasswordAction',  '_route' => 'user_changepassword',);
            }
            not_user_changepassword:

        }

        // user_updatepassword
        if ($pathinfo === '/updatepassword') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_user_updatepassword;
            }

            return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\DefaultController::updatePasswordAction',  '_route' => 'user_updatepassword',);
        }
        not_user_updatepassword:

        // user_adduser
        if ($pathinfo === '/adduser') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_user_adduser;
            }

            return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\DefaultController::addUserAction',  '_route' => 'user_adduser',);
        }
        not_user_adduser:

        if (0 === strpos($pathinfo, '/create')) {
            // create_password
            if ($pathinfo === '/createpassword') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_create_password;
                }

                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\DefaultController::createPasswordAction',  '_route' => 'create_password',);
            }
            not_create_password:

            // create_newPassword
            if (0 === strpos($pathinfo, '/createnewpassword') && preg_match('#^/createnewpassword/(?P<userId>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_create_newPassword;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'create_newPassword')), array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\DefaultController::createnewPasswordAction',));
            }
            not_create_newPassword:

        }

        if (0 === strpos($pathinfo, '/webservice')) {
            // user_facebooklogin
            if ($pathinfo === '/webservice/facebookapi') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_user_facebooklogin;
                }

                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\UserController::facebookAction',  '_route' => 'user_facebooklogin',);
            }
            not_user_facebooklogin:

            if (0 === strpos($pathinfo, '/webservice/e')) {
                if (0 === strpos($pathinfo, '/webservice/event')) {
                    // event_detail
                    if ($pathinfo === '/webservice/eventdetail') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_event_detail;
                        }

                        return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\EventsController::eventListAction',  '_route' => 'event_detail',);
                    }
                    not_event_detail:

                    // eventlocation_list
                    if ($pathinfo === '/webservice/eventlocation') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_eventlocation_list;
                        }

                        return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\EventsController::eventLocationAction',  '_route' => 'eventlocation_list',);
                    }
                    not_eventlocation_list:

                }

                if (0 === strpos($pathinfo, '/webservice/exihibitor')) {
                    if (0 === strpos($pathinfo, '/webservice/exihibitorlist')) {
                        // exhibitor_list
                        if ($pathinfo === '/webservice/exihibitorlist') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_exhibitor_list;
                            }

                            return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\ExhibitorController::exihibitorListAction',  '_route' => 'exhibitor_list',);
                        }
                        not_exhibitor_list:

                        // event_exhibitor_list
                        if ($pathinfo === '/webservice/exihibitorlistforevent') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_event_exhibitor_list;
                            }

                            return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\ExhibitorController::exihibitorListForEventAction',  '_route' => 'event_exhibitor_list',);
                        }
                        not_event_exhibitor_list:

                    }

                    // exhibitor_detail
                    if ($pathinfo === '/webservice/exihibitordetail') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_exhibitor_detail;
                        }

                        return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\ExhibitorController::exihibitorDetailAction',  '_route' => 'exhibitor_detail',);
                    }
                    not_exhibitor_detail:

                }

            }

            // map_list
            if ($pathinfo === '/webservice/maplist') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_map_list;
                }

                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\MapsController::mapListAction',  '_route' => 'map_list',);
            }
            not_map_list:

            // productcategory_list
            if ($pathinfo === '/webservice/productCategory') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_productcategory_list;
                }

                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\CategoryController::productCategoryListAction',  '_route' => 'productcategory_list',);
            }
            not_productcategory_list:

            // addUserFavourite
            if ($pathinfo === '/webservice/addUserFavourite') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_addUserFavourite;
                }

                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\UserFavouriteController::addUserFavouriteAction',  '_route' => 'addUserFavourite',);
            }
            not_addUserFavourite:

            // UserFavourite_list
            if ($pathinfo === '/webservice/UserFavouritelist') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_UserFavourite_list;
                }

                return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\ExhibitorController::UserfavouriteListAction',  '_route' => 'UserFavourite_list',);
            }
            not_UserFavourite_list:

        }

        // androidpush_notification
        if ($pathinfo === '/androidNotification') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_androidpush_notification;
            }

            return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\DefaultController::androidPushAction',  '_route' => 'androidpush_notification',);
        }
        not_androidpush_notification:

        // iospush_notification
        if ($pathinfo === '/iosNotification') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_iospush_notification;
            }

            return array (  '_controller' => 'DroidInfotech\\DroidBundle\\Controller\\DefaultController::iosPushAction',  '_route' => 'iospush_notification',);
        }
        not_iospush_notification:

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
