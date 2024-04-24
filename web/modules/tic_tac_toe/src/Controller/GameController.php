<?php

namespace Drupal\tic_tac_toe\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Cache\CacheableJsonResponse;
use Drupal\Core\Cache\CacheableMetadata;


class GameController extends ControllerBase
{

    public function move()
    {
        $request = \Drupal::requestStack()->getCurrentRequest();

        $user_ip = $request->getClientIp();
        $data = json_decode($request->getContent(), TRUE);
        $cell_number = $data['cell_number'] ?? NULL;

        $response = new CacheableJsonResponse(['message' => "Ups! $cell_number Something $user_ip went wrong. Please try again."]);
        
        if (!is_null($cell_number)) {
            \Drupal::database()->insert('tic_tac_toe_games')
                ->fields([
                    'user_ip' => $user_ip,
                    'cell_number' => $cell_number,
                    'created_at' => time(),
                ])
                ->execute();

            $move_count = \Drupal::database()->select('tic_tac_toe_games', 'g')
                ->condition('user_ip', $user_ip)
                ->countQuery()
                ->execute()
                ->fetchField();

            $response = new CacheableJsonResponse(['message' => "It's your " . $move_count . " move. Keep going!"]);
        }
        $response->addCacheableDependency(CacheableMetadata::createFromRenderArray(['#cache' => ['max-age' => 0]]));
        return $response;
    }
}
