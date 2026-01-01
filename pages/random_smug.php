<?php /***************************************************************************************************************/
/*                                                                                                                   */
/*                                            GENERATES A RANDOM SMUGGIE                                             */
/*                                                                                                                   */
/*********************************************************************************************************************/
include_once './../inc/includes.inc.php';

/**
 * Lists all images in a directory
 *
 * @param   string  $dir  The directory to look in
 *
 * @return  array         The list of images
 */

function smug_list_images(string $dir): array {
  return glob($dir . '/*.{jpg,jpeg,png,gif,webp,JPG,JPEG,PNG,GIF,WEBP}', GLOB_BRACE) ?: [];
}




/**
 * Loads an image
 *
 * @param   string  $path  The path to the image
 *
 * @return  array          The image and some data related to it
 */

function loadImage(string $path) {

  // Load the image and get its size
  $info = @getimagesize($path);

  // If there's no info, return null
  if (!$info)
    return [null, null];

  // Depending on the image type, load it
  switch ($info[2]) {
    case IMAGETYPE_JPEG:
      return [imagecreatefromjpeg($path), $info];
    case IMAGETYPE_PNG:
      return [imagecreatefrompng($path), $info];
    case IMAGETYPE_GIF:
      return [imagecreatefromgif($path), $info];
    case IMAGETYPE_WEBP:
      if (function_exists('imagecreatefromwebp'))
        return [imagecreatefromwebp($path), $info];
  }

  // If we got here, there was an error
  return [null, null];
}



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Seeding & Randomness

// Determine a seed for the image - or grab the provided seed if there's one
$seed = isset($_GET['seed']) ? (int)$_GET['seed'] : random_int(1, PHP_INT_MAX);

// Seed the random number generator
mt_srand($seed);

// Establish a list of possible layouts
$layouts = [
  'random_h'  => 80,
  'random_v'  => 80,
  'debate'    => 80,
  'dialogue'  => 80,
  'orange'    => 80,
  'green'     => 80,
  'marx'      => 50,
  'box'       => 50,
];

// List which layouts are vertical
$vertical_layouts = [
  'dialogue',
  'debate',
  'box',
  'memes',
];

// Sum the total weight of layouts
$total_weight = array_sum($layouts);

// Pick a random layout
$roll = mt_rand(1, $total_weight);

// Determine which layout got picked based on the weighted probabilities
$running = 0;
foreach ($layouts as $name => $weight)
{
  $running += $weight;
  if ($roll <= $running)
  {
    $layout = $name;
    break;
  }
}

// Decide whether the canvas should be vertical or horizontal
if ($layout === 'random_h') {
  $canvas_direction = 'horizontal';
} elseif ($layout === 'random_v') {
  $canvas_direction = 'vertical';
} else {
  $canvas_direction = in_array($layout, $vertical_layouts, true) ? 'vertical' : 'horizontal';
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Handle special random layouts

// Fetch the user's language
$lang = string_change_case(user_get_language(), 'lowercase');

// Handle random layouts
if($layout === 'random_h' || $layout === 'random_v')
{
  // List all existing layouts
  $dir_main = './../img/generator/' . $lang . '/';

  // From them, fetch only compatible layouts (don't want to mix vertical and horizontal)
  $available_layouts = array_filter(
    scandir($dir_main),
    function ($name) use ($dir_main, $vertical_layouts, $canvas_direction) {

      // No . no .. no meta layouts
      if ($name === '.' || $name === '..')
        return false;
      if ($name === 'random_h' || $name === 'random_v')
        return false;

      // Must be a directory
      $dir_layout = $dir_main . $name . '/';
      if (!is_dir($dir_layout))
        return false;

      // Must have proper panel subfolder structure
      for ($i = 1; $i <= 3; $i++) {
        if (!is_dir($dir_layout . $i . '/'))
          return false;
      }

      // Must match canvas direction
      $is_vertical = in_array($name, $vertical_layouts, true);

      // Only keep compatible layouts
      return
        ($canvas_direction === 'vertical'   && $is_vertical) ||
        ($canvas_direction === 'horizontal' && !$is_vertical);
    }
  );

  // Sort the layouts
  $available_layouts = array_values($available_layouts);

  // If no compatible layouts were found, stop here
  if (!$available_layouts) {
    exit('ERROR: Random mode could not find any compatible layouts');
  }

  // Randomly select a layout for each panel
  $panel_layouts = [
    $available_layouts[mt_rand(0, count($available_layouts) - 1)],
    $available_layouts[mt_rand(0, count($available_layouts) - 1)],
    $available_layouts[mt_rand(0, count($available_layouts) - 1)],
  ];
}

// Normal layout
else
  $panel_layouts = [$layout, $layout, $layout];




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Fetch the comic's panels

// Prepare an array to store panels in
$panels = [];
$folders = [];

// Determine which folders to look in for images
for ($i = 0; $i < 3; $i++)
  $folders[] = './../img/generator/'.$lang .'/'.$panel_layouts[$i].'/'.($i + 1).'/';

// Go through the folders
foreach ($folders as $dir)
{
  // Grab the list of images in the folder
  $files = smug_list_images($dir);

  // If there are no images, stop here with an error
  if (!$files)
    exit("ERROR: Could not generate smuggie, directory is empty");

  // Pick a random image
  $path = $files[mt_rand(0, count($files) - 1)];

  // Load the image
  [$im, $info] = loadImage($path);

  // If there was an error, stop here
  if (!$im)
    exit("ERROR: Could not load image $path");

  // Add the panel to the list
  $panels[] = [
    'im'  => $im      ,
    'w'   => $info[0] ,
    'h'   => $info[1]
  ];
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Calculate the size of the comic

// Determine the size of the gap between panels
$gap = 8;

// Calculate the size of vertical canvases
if($canvas_direction === 'vertical')
{
  $comicW = max(
    $panels[0]['w'],
    $panels[1]['w'],
    $panels[2]['w']
  );
  $comicH =
    $panels[0]['h'] +
    $panels[1]['h'] +
    $panels[2]['h'] +
    $gap * 2;
}

// Calculate the size of horizontal canvases
else
{
  $comicH = max(
    $panels[0]['h'],
    $panels[1]['h'],
    $panels[2]['h']
  );

  // Smaller images are resized to the size of bigger ones in horizontal layouts
  $comicW = 0;
  foreach ($panels as $p)
    $comicW += (int) round($p['w'] * ($comicH / $p['h']));
  $comicW += $gap * 2;
}





///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Create the canvas

// Create the canvas
$out = imagecreatetruecolor($comicW, $comicH);

// Fill the canvas with black
$black = imagecolorallocate($out, 0, 0, 0);
imagefilledrectangle($out, 0, 0, $comicW, $comicH, $black);




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Assemble the comic

// Vertical canvas
if($canvas_direction === 'vertical')
{
  $y = 0;
  foreach ($panels as $p)
  {
    $x = intdiv($comicW - $p['w'], 2);
    imagecopy($out, $p['im'], $x, $y, 0, 0, $p['w'], $p['h']);
    $y += $p['h'] + $gap;
    unset($p['im']);
  }
}

// Horizontal canvas
else
{
  $x = 0;
  foreach ($panels as $p)
  {
    // Scale the canvas to match the height of the tallest panel
    $scale = $comicH / $p['h'];
    $newW = (int) round($p['w'] * $scale);
    $newH = $comicH;

    // Resize each panel
    $resized = imagecreatetruecolor($newW, $newH);

    // Resize the panel
    imagecopyresampled($resized, $p['im'], 0, 0, 0, 0, $newW, $newH, $p['w'], $p['h'] );

    // Paste at baseline
    imagecopy($out, $resized, $x, 0, 0, 0, $newW, $newH);

    // Remember to calculate the width of the gap between panels
    $x += $newW + $gap;

    // Destroy the resized image
    unset($resized);
    unset($p['im']);
  }
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Output

// Display the image
header('Content-Type: image/png');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');

// Show the image
imagepng($out, null, 6);

// Destroy the image
unset($out);