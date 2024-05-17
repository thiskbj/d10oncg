<?php

namespace Drupal\cmsp;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\workflows\Entity\Workflow;
use Drupal\workflows\WorkflowInterface;
use Drupal\content_moderation\ContentModerationState;

class ContentModerationStatePermissions {
  use StringTranslationTrait;

  /**
   * Returns an array of state permissions.
   *
   * @return array
   *   The state permissions.
   */
  public function permissions() {
    $permissions = [];
    /** @var WorkflowInterface $workflow */
    foreach (Workflow::loadMultipleByType('content_moderation') as $workflow) {
      /** @var ContentModerationState $state */
      foreach ($workflow->getTypePlugin()->getStates() as $state) {
        if ($state->isPublishedState()) {
          // We don't need to control access to published states.
          continue;
        }
        $permissions['View revisions in ' . $workflow->id() . ' state ' . $state->id()] = [
          'title' => $this->t('%workflow workflow: View %state state.', [
            '%workflow' => $workflow->label(),
            '%state' => $state->label(),
          ]),
          'description' => $this->t('View content revisions in %state state.', ['%state' => $state->label()]),
          'dependencies' => [
            $workflow->getConfigDependencyKey() => [$workflow->getConfigDependencyName()],
          ],
        ];
      }
    }

    return $permissions;
  }
}
