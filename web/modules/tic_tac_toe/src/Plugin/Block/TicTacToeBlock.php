<?php

namespace Drupal\tic_tac_toe\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'TicTacToe' Block.
 *
 * @Block(
 *   id = "tic_tac_toe_block",
 *   admin_label = @Translation("TicTacToe block"),
 * )
 */
class TicTacToeBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#theme' => 'tic_tac_toe_template',
      '#attached' => [
        'library' => [
          'tic_tac_toe/tic_tac_toe_library',
        ],
      ],
    ];
  }

}