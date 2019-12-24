<template>
    <div id="audio-player-container" :class="{ errorMessage: error }">
        <iframe
            width="auto"
            height="auto"
            scrolling="no"
            frameborder="no"
            src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/652493990&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true"
            ref="scplayer"
        ></iframe>
        <div :class="{ player: true, canplay: canplay }">
            <div class="btn-play" v-if="isPause" @click="onClickPlayBtn"></div>
            <div class="btn-pause" v-if="isPlay" @click="onClickPauseBtn"></div>
            <div class="currentText">{{ currentText }}</div>
            <div ref="progress-bar" class="progress-bar" @click.stop.prevent="onCLickProgressBar">
                <div class="buffered" v-bind:style="bufferedStyle"></div>
                <div class="current" v-bind:style="currentStyle"></div>
            </div>
            <div class="durationText">{{ durationText }}</div>
            <div class="volume-group">
                <div class="volume-bar" @click="onClickVolumeBar">
                    <div class="currentVolume" v-bind:style="currentVolume"></div>
                </div>
                <div class="btn-muted" v-if="muted" @click="onClickMutedBtn"></div>
                <div class="btn-volume" v-if="!muted" @click="onClickVolumeBtn"></div>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
require('../../protos/String');
export default {
    data() {
        return {
            SC_Player: null,
            isPlay: false,
            volume: 30,
            muted: false,
            buffered: 0,
            canplay: false,
            currentTime: 0,
            duration: 0,
            ratio: 0,
            error: false,
            progressBarEloffsetWidth: null,
        };
    },

    props: {
        src: String,
    },

    created() {
        // console.log(this.$refs['scplayer']);
        // this.SC_Player = SC.Widget(this.$refs.scplayer);
        // console.log(
        //     this.SC_Player.getSound(val => {
        //         console.log(val);
        //     })
        // );
        // this.initAudioEvent();
        // // this.SC_Player = SC.Widget(this.$refs.scplayer);
        // // console.log(this.SC_Player);
        // // this.initAudioEvent();
    },

    mounted() {
        this.SC_Player = SC.Widget(this.$refs.scplayer);
        this.initAudioEvent();
        if (this.canplay) this.progressBarEloffsetWidth = this.$refs['progress-bar'].offsetWidth;
    },

    watch: {
        isPlay(newVal, oldVal) {
            if (newVal) {
                this.SC_Player.play();
            } else if (oldVal) {
                this.SC_Player.pause();
            }
        },

        muted(n, o) {
            this.SC_Player.muted = n;
        },

        volume(n, o) {
            this.SC_Player.volume = n / 100;
        },
    },

    computed: {
        isPause: function() {
            return !this.isPlay;
        },

        currentPercent: function() {
            return (100 * this.currentTime) / 1;
        },

        currentStyle: function() {
            return { width: this.currentPercent + '%' };
        },

        bufferedStyle: function() {
            return { width: this.buffered + '%' };
        },

        currentVolume: function() {
            return { width: this.volume + '%' };
        },

        currentText() {
            return this.secondToTime(this.currentTime);
        },

        durationText() {
            return this.secondToTime(this.duration / 1000);
        },
    },

    methods: {
        secondToTime(second) {
            var date = new Date(null);
            date.setSeconds(second);
            return date
                .toISOString()
                .substr(11, 8)
                .replace(/(?:00:)+(\d{2}\:\d{2})/g, '$1');
        },

        initAudioEvent() {
            let self = this;
            this.SC_Player.bind(SC.Widget.Events.READY, () => {
                this.canplay = 1;
                this.volume++;

                this.SC_Player.getDuration(val => {
                    this.duration = val;
                    this.ratio = this.progressBarEloffsetWidth / this.duration;
                });

                this.SC_Player.bind(SC.Widget.Events.PLAY_PROGRESS, () => {
                    // self.currentTime = this.currentTime;
                    // self.buffered =
                    //     (100 * this.buffered.end(this.buffered.length - 1)) / this.duration;
                });
            });

            // this.SC_Player.addEventListener('canplaythrough', function(e) {});
            // this.SC_Player.addEventListener('error', function(e) {
            //     self.isPlay = false;
            //     self.canplay = false;
            //     self.error = true;
            // });
            // this.SC_Player.addEventListener('ended', function(e) {
            //     self.isPlay = false;
            // });
        },

        onCLickProgressBar(event) {
            this.progressBarEloffsetWidth = this.$refs['progress-bar'].offsetWidth;
            this.ratio = this.progressBarEloffsetWidth / this.SC_Player.duration;
            this.SC_Player.currentTime = event.offsetX / this.ratio;
            !this.isPlay && this.SC_Player.pause();
        },

        onClickPauseBtn(event) {
            this.isPlay = false;
        },

        onClickPlayBtn(event) {
            if (this.canplay) {
                this.isPlay = true;
            }
        },

        onClickVolumeBar(event) {
            this.volume = event.offsetX;
        },

        onClickVolumeBtn(event) {
            this.muted = true;
        },

        onClickMutedBtn(event) {
            this.muted = false;
        },
    },
};
</script>
<style type="text/css" lang="scss" scoped>
div#audio-player-container {
    overflow: hidden;
    display: flex;
    flex: 1;
    background: #f1f3f4;
    height: 27px;
    border-radius: 3px;
    position: relative;
    iframe {
        z-index: 1;
        position: fixed;
        top: 50px;
        width: 622px;
    }
    .player {
        display: flex;
        background: #f1f3f4;
        height: 27px;
        align-items: center;
        padding: 0px 0px;
        margin-top: 27px;
        width: 100%;
        position: relative;
        transition: all 0.5s ease-in-out;

        &:before {
            width: 100%;
            height: 100%;
            top: -100%;
            content: 'LOADING ... ';
            font-size: 15px;
            font-family: monospace;
            font-size: 12px;
            font-weight: bold;
            color: #444;
            justify-content: center;
            align-items: center;
            position: absolute;
            display: flex;
        }

        .currentText,
        .durationText {
            font-size: 13px;
            font-family: sans-serif;
        }
        .currentText {
            margin-right: 10px;
        }
        .durationText {
            margin-left: 10px;
        }
        .progress-bar {
            height: 4px;
            flex-grow: 1;
            margin: 0;
            background: #c1c3c3;
            border-radius: 5px;
            position: relative;
            .buffered,
            .current {
                position: absolute;
                height: 100%;
                border-radius: 5px;
            }

            .buffered {
                background: #757575;
            }
            .current {
                background: #0b0b0b;
            }
        }
        .btn-muted,
        .btn-play,
        .btn-pause,
        .btn-volume {
            &:before {
                content: '';
                width: 15px;
                height: 100%;
                display: block;
            }
        }
        .btn-play {
            padding: 0 10px 0 5px;
            height: 100%;
            &:before {
                background-image: url('/svg/play.svg');
            }
        }
        .btn-pause {
            padding: 0 10px 0 5px;
            height: 100%;
            &:before {
                background-image: url('/svg/pause.svg');
            }
        }
        .btn-muted {
            height: 100%;
            padding-left: 10px;
            padding-right: 5px;
            &:before {
                background-image: url('/svg/muted.svg');
            }
        }
        .btn-volume {
            height: 100%;
            padding-left: 10px;
            padding-right: 5px;
            &:before {
                background-image: url('/svg/volume.svg');
            }
        }

        .volume-group {
            display: flex;
            width: 30px;
            height: 100%;
            align-items: center;
            transition: all 0.5s ease-in-out;
            overflow: hidden;
            &:hover {
                width: 120px;
                margin-left: 10px;
                border-top-left-radius: 5px;
                border-bottom-left-radius: 5px;
            }

            .volume-bar {
                width: 100px;
                height: 100%;
                align-self: center;
                position: relative;

                &:before {
                    content: '';
                    height: 4px;
                    display: block;
                    position: absolute;
                    width: 100%;
                    top: 50%;
                    left: 0;
                    -webkit-transform: translateY(-50%);
                    transform: translateY(-50%);
                    background: #c1c3c3;
                    border-radius: 5px;
                }

                .currentVolume {
                    height: 4px;
                    top: 50%;
                    left: 0;
                    transform: translateY(-50%);
                    position: absolute;
                    background: #0b0b0b;
                    z-index: 100;
                }
            }
        }
    }
    .canplay {
        margin-top: 0 !important;
    }
}
.errorMessage {
    &:before {
        content: "Error, Can't Play Audio !";
        height: 100%;
        width: 100%;
        font-size: 13px;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        z-index: 1;
        background: #000000;
    }
}
</style>
