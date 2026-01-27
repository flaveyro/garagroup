<?php

if (!class_exists('VVT_Navwalker')) {

  class VVT_Navwalker extends Walker_Nav_Menu {

    public function start_lvl(&$output, $depth = 0, $args = null) {
      $indent = str_repeat("\t", $depth);
      $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
      $indent = ($depth) ? str_repeat("\t", $depth) : '';

      $has_children = !empty($args->has_children);

      $classes = empty($item->classes) ? [] : (array) $item->classes;

      if ($depth === 0) {
        $classes[] = 'nav-item';
        if ($has_children) $classes[] = 'dropdown';
      } else {
        $classes[] = 'dropdown-item-wrapper';
      }

      $class_names = join(' ', array_filter($classes));
      $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

      $output .= $indent . '<li' . $class_names . '>';

      $atts = [];
      $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
      $atts['target'] = !empty($item->target) ? $item->target : '';
      $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
      $atts['href']   = !empty($item->url) ? $item->url : '';

      if ($depth === 0) {
        $link_class = 'nav-link';
        if ($has_children) {
          $link_class .= ' dropdown-toggle';
          $atts['data-bs-toggle'] = 'dropdown';
          $atts['role'] = 'button';
          $atts['aria-expanded'] = 'false';
        }
        $atts['class'] = $link_class;
      } else {
        $atts['class'] = 'dropdown-item';
      }

      $attributes = '';
      foreach ($atts as $attr => $value) {
        if ($value !== '') {
          $value = ($attr === 'href') ? esc_url($value) : esc_attr($value);
          $attributes .= ' ' . $attr . '="' . $value . '"';
        }
      }

      $title = apply_filters('the_title', $item->title, $item->ID);

      $item_output  = $args->before ?? '';
      $item_output .= '<a' . $attributes . '>';
      $item_output .= ($args->link_before ?? '') . $title . ($args->link_after ?? '');
      $item_output .= '</a>';
      $item_output .= $args->after ?? '';

      $output .= $item_output;
    }

    public function end_el(&$output, $item, $depth = 0, $args = null) {
      $output .= "</li>\n";
    }

    public function display_element($element, &$children_elements, $max_depth, $depth = 0, $args = [], &$output = '') {
      if (isset($args[0]) && is_object($args[0])) {
        $args[0]->has_children = !empty($children_elements[$element->ID]);
      }
      parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
  }
}
