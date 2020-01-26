<?php
namespace AppBundle\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;
use Symfony\Component\Routing\RouterInterface;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{ 

    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }
public function handle(Request $request, AccessDeniedException $accessDeniedException)
{
// ...
$content="ook";
//return new Response($content, 403);

   // return $this->render('Default/AccesDenied.html.twig');


    $request->getSession()->getFlashbag()->add('error', 'Error 403!...');
    $url = $this->router->generate('accessDenied');

    return new RedirectResponse($url);
  //  return $this->render('Default/AccesDenied.html.twig');

}
}