<?php

function getComponents($response)
{
  $result = [];
  
  foreach ($response->find('.image-and-text-overlay_hpm, .video_hpm, .three-image-and-text_hpm') as $temp) {
    $temp_result = [];
    
    if ($temp->hasClass('image-and-text-overlay_hpm')) {
      $temp_result = getOverlay($temp);
    } else if ($temp->hasClass('video_hpm')) {
      $temp_result = getVideo($temp);
    } else if ($temp->hasClass('three-image-and-text_hpm')) {
      $temp_result = getCols($temp);
    }
    
    $result = array_merge($result, $temp_result);
  }
  return $result;
}

function getOverlay($response)
{
  return [
    [
      'component' => 'Picture',
      'props' => [
        'src' => $response->find('.desktop-img_hpm', 0)->src,
        'srcMob' => $response->find('.mobile-img_hpm', 0)->src,
      ]
    ],
    [
      'component' => 'Title',
      'props' => [
        "textAlign" => "left",
        "fontSize" => "18",
        'content' => $response->find('.h4_hpm', 0)->plaintext,
        "color" => "#000000",
        "background" => "#ffffff",
        "fontFamily" => "Arial",
        "fontWeight" => "600"
      ]
    ],
    [
      "component" => "Spacer",
      "props" => [
        "background" => "#ffffff",
        "size" => "small"
      ]
    ],
    [
      'component' => 'Description',
      'props' => [
        "textAlign" => "left",
        "fontSize" => "13",
        'content' => $response->find('.desc_hpm', 0)->plaintext,
        "color" => "#000000",
        "background" => "#ffffff",
        "fontFamily" => "Arial",
        "fontWeight" => "400"
      ]
    ],
    [
      "component" => "Spacer",
      "props" => [
        "background" => "#ffffff",
        "size" => "small"
      ]
    ],
  ];
}

function getVideo($response)
{
  return [
    [
      'component' => 'Video',
      'props' => [
        "src" => $response->find('source', 0)->src,
        "poster" => $response->poster ?? ''
      ],
    ],
    [
      "component" => "Spacer",
      "props" => [
        "background" => "#ffffff",
        "size" => "small"
      ]
    ],
  ];
}

function getCols($response)
{

  $innerElements = [];
  foreach ($response->find('.box_hpm') as $box) {
    $innerElements[] = [
      'component' => 'Col',
      "props" => [
        "titleContent" => $box->find('.h4_hpm', 0)->plaintext,
        "descriptionContent" => $box->find('.p_hpm', 0)->plaintext,
        "src" => $box->find('img', 0)->src,
      ]
    ];
  }
  $componentData = [
    [
      "component" => "Title",
      "props" => [
        "textAlign" => "left",
        "fontSize" => "3",
        "content" => $response->find('.module-header_hpm', 0)->plaintext,
        "color" => "#111111",
        "background" => "#ffffff",
        "fontFamily" => "Arial",
        "fontWeight" => "994.81"
      ]
    ],
    [
      "component" => "Spacer",
      "props" => [
        "background" => "#ffffff",
        "size" => "small"
      ]
    ],
    [
      'component' => 'Col3',
      'props' => [
        "background" => "#ffffff",
        "textAlign" => "center",
        "titleFontSize" => "18",
        "titleColor" => "#000000",
        "titleFontFamily" => "Arial",
        "titleFontWeight" => "500",
        "descriptionFontSize" => "13",
        "descriptionColor" => "#000000",
        "descriptionFontFamily" => "Arial",
        "descriptionFontWeight" => "400",
        'innerElements' => $innerElements
      ]
    ]
  ];
  return $componentData;
}
