<template>
    <div class="container">
        <div class="viewer">
            <div id="viewer"></div>
            <div class="top-controls">
                <button class="mdc-icon-button material-icons" @click="viewer.viewport.goHome()">fullscreen_exit</button>
            </div>
            <div class="left-controls">
                <button class="mdc-icon-button material-icons" @click="$router.push('/view/'+id+'/'+(parseInt(page)-1))" v-if="parseInt(page) > 1">chevron_left</button>
            </div>
            <div class="right-controls">
                <button class="mdc-icon-button material-icons" @click="$router.push('/view/'+id+'/'+(parseInt(page)+1))" v-if="parseInt(page) < file.page_count">chevron_right</button>
            </div>
        </div>
    </div>
</template>

<script>
    import OpenSeadragon from 'openseadragon'

    export default {
        props: {
            id: {},
            page: {
                type: String,
                default: "1"
            }
        },
        data() {
            return {
                file: false
            }
        },
        mounted() {
            this.loadFile()
            this.load()
        },
        methods: {
            loadFile() {
                let that = this
                axios.get('/api/files/'+this.id).then(res => {
                    that.file = res.data
                })
            },
            load() {
                if(this.viewer) this.viewer.destroy()
                this.viewer = OpenSeadragon({
                    id: 'viewer',
                    tileSources: '/dzi/'+this.id+'/'+this.page,
                    showNavigationControl: false,
                    showZoomControl: false,
                    showHomeControl: false,
                    showFullPageControl: false,
                    showSequenceControl: false
                })
            }
        },
        computed: {
        },
        watch: {
            id() {
                this.loadFile()
                this.load()
            },
            page() {
                this.load()
            }
        }
    }
</script>

<style lang="scss">

    .viewer {
        position: relative;
        width: 100%;
        height: calc(100vh - 104px);
        background: rgba(0,0,0,0.9);
        color: rgba(255,255,255,0.8);
    
        #viewer {
            width: 100%;
            height: 100%;
        }

        .top-controls {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            padding: 8px;
        }

        .left-controls {
            position: absolute;
            left: 0;
            top: calc(50% - 12px);
            bottom: 0;
            padding: 8px;
        }

        .right-controls {
            position: absolute;
            right: 0;
            top: calc(50% - 12px);
            bottom: 0;
            padding: 8px;
        }
    }

</style>
