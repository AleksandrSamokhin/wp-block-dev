import { InnerBlocks, useBlockProps } from "@wordpress/block-editor"

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#save
 *
 * @return {Element} Element to render.
 */
export default function save({ attributes }) {
  const { slidesPerView, autoplay, loop, pagination, navigation } = attributes

  const blockProps = useBlockProps.save({
    className: "wp-block-dev-slider swiper"
  })

  const swiperOptions = {
    slidesPerView,
    autoplay,
    loop,
    pagination,
    navigation
  }

  return (
    <div {...blockProps} data-swiper-options={JSON.stringify(swiperOptions)}>
      <div className="swiper-wrapper">
        <InnerBlocks.Content />
      </div>

      {pagination && <div className="swiper-pagination"></div>}

      {navigation && (
        <>
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
        </>
      )}
    </div>
  )
}
