<?php
namespace Drupal\custom_module\StackMiddleware;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * Performs a custom task.
 */
class InvalidateStackMiddleware implements HttpKernelInterface {

  /**
   * The wrapped HTTP kernel.
   *
   * @var \Symfony\Component\HttpKernel\HttpKernelInterface
   */
  protected $httpKernel;

  /**
   * Creates a HTTP middleware handler.
   *
   * @param \Symfony\Component\HttpKernel\HttpKernelInterface $kernel
   *   The HTTP kernel.
   */
  public function __construct(HttpKernelInterface $kernel) {
    $this->httpKernel = $kernel;
  }

  /**
   * {@inheritdoc}
   */
  public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = TRUE) {
    \Drupal::service('cache_tags.invalidator')->invalidateTags(['backend_overridable']);  
    return $this->httpKernel->handle($request, $type, $catch);
  }
}