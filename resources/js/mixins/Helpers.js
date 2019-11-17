export default {
    methods: {
        initMasonry() {
            this.masonry = new Masonry('.grid', {
                itemSelector: '.grid-item',
                percentPosition: true,
                columnWidth: '.grid-sizer',
                horizontalOrder: true,
                gutter: 16
            })
        },
        removeItems(cb) {
            let that = this
            this.destroying = true
            let items = $('.grid-item--animating')
            if(items.length > 0) {
                items.each((i, e) => {
                    $(e).removeClass('grid-item--animating')
                    if(i == items.length-1) {
                        setTimeout(() => {
                            that.destroying = false
                            cb()
                        }, 200)
                    }
                })
            } else cb()
        }
    }
}
