if (typeof OpenLayers != 'undefined') OpenLayers.Layer.Vector.prototype.renderers = ["Canvas", "SVG", "VML"];

/**
 * Javascript Drupal Theming function for inside of Popups
 *
 * To override
 *
 * @param feature
 *  OpenLayers feature object.
 * @return
 *  Formatted HTML.
 */
Drupal.theme.prototype.openlayersPopup = function(feature) {
  var output = '';

  if (feature.attributes.name && feature.attributes.id) {
    output += '<div style="font-weight:bold; margin: 5px 0;"><a href="' + Drupal.settings.basePath + 'node/' + feature.attributes.id + '">' + feature.attributes.name + '</a></div>';
  } else if (feature.attributes.name) {
    output += '<div style="font-weight:bold; margin: 5px 0;">' + feature.attributes.name + '</div>';
  }
  if (feature.attributes.description) {
    output += '<div style="margin: 5px 0; max-width: 480px;">' + feature.attributes.description + '</div>';
  }
  if (feature.attributes.image) {
    output += '<img src="' + Drupal.settings.basePath + 'sites/default/files/styles/large/public/' + feature.attributes.image + '" />';
  }

  var edit = '';
  if (Drupal.settings.currentUid > 0) {
    edit = ' | <a href="' + Drupal.settings.basePath + 'node/' + feature.attributes.nid + '/edit">Edit</a>'
  }

  if (feature.layer && (feature.layer.drupalID === 'reports_wfs' || feature.layer.drupalID === 'reports_unpublished_wfs')) {
    output += '<div><a href="' + Drupal.settings.basePath + 'node/' + feature.attributes.nid + '#comments">Comments</a>' + edit + '</div>';
  }

  return output;
};

jQuery(document).ready(function() {
  var map = jQuery('#openlayers-map').data('openlayers');
  if (map && map.openlayers.getLayersBy('drupalID', 'poi_wfs').length > 0) {
    var layer = map.openlayers.getLayersBy('drupalID', 'poi_wfs')[0],
      layer_clustered = map.openlayers.getLayersBy('drupalID', 'poi_wfs_clustered')[0];

    if (jQuery.browser.msie && parseInt(jQuery.browser.version) < 9) {
      layer.protocol.params.maxFeatures = 100;
      layer_clustered.protocol.params.maxFeatures = 100;
    }

    layer_clustered.setVisibility(true);
    layer.setVisibility(true);
  }
});
