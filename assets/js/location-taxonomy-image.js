jQuery(document).ready(function ($) {
  var mediaUploader

  $("#location_taxonomy_media_button").click(function (e) {
    e.preventDefault()

    if (mediaUploader) {
      mediaUploader.open()
      return
    }

    mediaUploader = wp.media({
      title: "Choose Location Image",
      button: {
        text: "Use this image"
      },
      multiple: false
    })

    mediaUploader.on("select", function () {
      var attachment = mediaUploader.state().get("selection").first().toJSON()
      $("#location-taxonomy-image").val(attachment.id)
      $("#location-taxonomy-image-wrapper").html('<img src="' + attachment.url + '" style="max-width:100%;"/>')
    })

    mediaUploader.open()
  })

  $("#location_taxonomy_media_remove").click(function () {
    $("#location-taxonomy-image").val("")
    $("#location-taxonomy-image-wrapper").html("")
  })
})
