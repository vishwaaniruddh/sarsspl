(function() {
    var b, d, c;
    b = jQuery;
    c = (function() {
        function b() {
            this.fadeDuration = 500;
            this.fitImagesInViewport = true;
            this.resizeDuration = 700;
            this.showImageNumberLabel = true;
            this.wrapAround = false
        }
        b.prototype.albumLabel = function(b, c) {
            return "Image " + b + " of " + c
        };
        return b
    })();
    d = (function() {
        function c(b) {
            this.options = b;
            this.album = [];
            this.currentImageIndex = void 0;
            this.init()
        }
        c.prototype.init = function() {
            this.enable();
            return this.build()
        };
        c.prototype.enable = function() {
            var c = this;
            return b('body').on('click', 'a[rel^=lightbox], area[rel^=lightbox], a[data-lightbox], area[data-lightbox]', function(d) {
                c.start(b(d.currentTarget));
                return false
            })
        };
        c.prototype.build = function() {
            var c = this;
            b("<div id='lightboxOverlay' class='lightboxOverlay'></div><div id='lightbox' class='lightbox'><div class='lb-outerContainer'><div class='lb-container'><img class='lb-image' src='' /><div class='lb-nav'><a class='lb-prev' href='' ></a><a class='lb-next' href='' ></a></div><div class='lb-loader'><a class='lb-cancel'></a></div></div></div><div class='lb-dataContainer'><div class='lb-data'><div class='lb-details'><span class='lb-caption'></span><span class='lb-number'></span></div><div class='lb-closeContainer'><a class='lb-close'></a></div></div></div></div>").appendTo(b('body'));
            this.$lightbox = b('#lightbox');
            this.$overlay = b('#lightboxOverlay');
            this.$outerContainer = this.$lightbox.find('.lb-outerContainer');
            this.$container = this.$lightbox.find('.lb-container');
            this.containerTopPadding = parseInt(this.$container.css('padding-top'), 10);
            this.containerRightPadding = parseInt(this.$container.css('padding-right'), 10);
            this.containerBottomPadding = parseInt(this.$container.css('padding-bottom'), 10);
            this.containerLeftPadding = parseInt(this.$container.css('padding-left'), 10);
            this.$overlay.hide().on('click', function() {
                c.end();
                return false
            });
            this.$lightbox.hide().on('click', function(d) {
                if (b(d.target).attr('id') === 'lightbox') {
                    c.end()
                }
                return false
            });
            this.$outerContainer.on('click', function(d) {
                if (b(d.target).attr('id') === 'lightbox') {
                    c.end()
                }
                return false
            });
            this.$lightbox.find('.lb-prev').on('click', function() {
                if (c.currentImageIndex === 0) {
                    c.changeImage(c.album.length - 1)
                } else {
                    c.changeImage(c.currentImageIndex - 1)
                }
                return false
            });
            this.$lightbox.find('.lb-next').on('click', function() {
                if (c.currentImageIndex === c.album.length - 1) {
                    c.changeImage(0)
                } else {
                    c.changeImage(c.currentImageIndex + 1)
                }
                return false
            });
            return this.$lightbox.find('.lb-loader, .lb-close').on('click', function() {
                c.end();
                return false
            })
        };
        c.prototype.start = function(c) {
            var f, e, j, d, g, n, o, k, l, m, p, h, i;
            b(window).on("resize", this.sizeOverlay);
            b('select, object, embed').css({
                visibility: "hidden"
            });
            this.$overlay.width(b(document).width()).height(b(document).height()).fadeIn(this.options.fadeDuration);
            this.album = [];
            g = 0;
            j = c.attr('data-lightbox');
            if (j) {
                h = b(c.prop("tagName") + '[data-lightbox="' + j + '"]');
                for (d = k = 0, m = h.length; k < m; d = ++k) {
                    e = h[d];
                    this.album.push({
                        link: b(e).attr('href'),
                        title: b(e).attr('title')
                    });
                    if (b(e).attr('href') === c.attr('href')) {
                        g = d
                    }
                }
            } else {
                if (c.attr('rel') === 'lightbox') {
                    this.album.push({
                        link: c.attr('href'),
                        title: c.attr('title')
                    })
                } else {
                    i = b(c.prop("tagName") + '[rel="' + c.attr('rel') + '"]');
                    for (d = l = 0, p = i.length; l < p; d = ++l) {
                        e = i[d];
                        this.album.push({
                            link: b(e).attr('href'),
                            title: b(e).attr('title')
                        });
                        if (b(e).attr('href') === c.attr('href')) {
                            g = d
                        }
                    }
                }
            }
            f = b(window);
            o = f.scrollTop() + f.height() / 10;
            n = f.scrollLeft();
            this.$lightbox.css({
                top: o + 'px',
                left: n + 'px'
            }).fadeIn(this.options.fadeDuration);
            this.changeImage(g)
        };
        c.prototype.changeImage = function(f) {
            var d, c, e = this;
            this.disableKeyboardNav();
            d = this.$lightbox.find('.lb-image');
            this.sizeOverlay();
            this.$overlay.fadeIn(this.options.fadeDuration);
            b('.lb-loader').fadeIn('slow');
            this.$lightbox.find('.lb-image, .lb-nav, .lb-prev, .lb-next, .lb-dataContainer, .lb-numbers, .lb-caption').hide();
            this.$outerContainer.addClass('animating');
            c = new Image();
            c.onload = function() {
                var m, g, h, i, j, k, l;
                d.attr('src', e.album[f].link);
                m = b(c);
                d.width(c.width);
                d.height(c.height);
                if (e.options.fitImagesInViewport) {
                    l = b(window).width();
                    k = b(window).height();
                    j = l - e.containerLeftPadding - e.containerRightPadding - 20;
                    i = k - e.containerTopPadding - e.containerBottomPadding - 110;
                    if ((c.width > j) || (c.height > i)) {
                        if ((c.width / j) > (c.height / i)) {
                            h = j;
                            g = parseInt(c.height / (c.width / h), 10);
                            d.width(h);
                            d.height(g)
                        } else {
                            g = i;
                            h = parseInt(c.width / (c.height / g), 10);
                            d.width(h);
                            d.height(g)
                        }
                    }
                }
                return e.sizeContainer(d.width(), d.height())
            };
            c.src = this.album[f].link;
            this.currentImageIndex = f
        };
        c.prototype.sizeOverlay = function() {
            return b('#lightboxOverlay').width(b(document).width()).height(b(document).height())
        };
        c.prototype.sizeContainer = function(f, g) {
            var b, d, e, h, c = this;
            h = this.$outerContainer.outerWidth();
            e = this.$outerContainer.outerHeight();
            d = f + this.containerLeftPadding + this.containerRightPadding;
            b = g + this.containerTopPadding + this.containerBottomPadding;
            this.$outerContainer.animate({
                width: d,
                height: b
            }, this.options.resizeDuration, 'swing');
            setTimeout(function() {
                c.$lightbox.find('.lb-dataContainer').width(d);
                c.$lightbox.find('.lb-prevLink').height(b);
                c.$lightbox.find('.lb-nextLink').height(b);
                c.showImage()
            }, this.options.resizeDuration)
        };
        c.prototype.showImage = function() {
            this.$lightbox.find('.lb-loader').hide();
            this.$lightbox.find('.lb-image').fadeIn('slow');
            this.updateNav();
            this.updateDetails();
            this.preloadNeighboringImages();
            this.enableKeyboardNav()
        };
        c.prototype.updateNav = function() {
            this.$lightbox.find('.lb-nav').show();
            if (this.album.length > 1) {
                if (this.options.wrapAround) {
                    this.$lightbox.find('.lb-prev, .lb-next').show()
                } else {
                    if (this.currentImageIndex > 0) {
                        this.$lightbox.find('.lb-prev').show()
                    }
                    if (this.currentImageIndex < this.album.length - 1) {
                        this.$lightbox.find('.lb-next').show()
                    }
                }
            }
        };
        c.prototype.updateDetails = function() {
            var b = this;
            if (typeof this.album[this.currentImageIndex].title !== 'undefined' && this.album[this.currentImageIndex].title !== "") {
                this.$lightbox.find('.lb-caption').html(this.album[this.currentImageIndex].title).fadeIn('fast')
            }
            if (this.album.length > 1 && this.options.showImageNumberLabel) {
                this.$lightbox.find('.lb-number').text(this.options.albumLabel(this.currentImageIndex + 1, this.album.length)).fadeIn('fast')
            } else {
                this.$lightbox.find('.lb-number').hide()
            }
            this.$outerContainer.removeClass('animating');
            this.$lightbox.find('.lb-dataContainer').fadeIn(this.resizeDuration, function() {
                return b.sizeOverlay()
            })
        };
        c.prototype.preloadNeighboringImages = function() {
            var c, b;
            if (this.album.length > this.currentImageIndex + 1) {
                c = new Image();
                c.src = this.album[this.currentImageIndex + 1].link
            }
            if (this.currentImageIndex > 0) {
                b = new Image();
                b.src = this.album[this.currentImageIndex - 1].link
            }
        };
        c.prototype.enableKeyboardNav = function() {
            b(document).on('keyup.keyboard', b.proxy(this.keyboardAction, this))
        };
        c.prototype.disableKeyboardNav = function() {
            b(document).off('.keyboard')
        };
        c.prototype.keyboardAction = function(g) {
            var d, e, f, c, b;
            d = 27;
            e = 37;
            f = 39;
            b = g.keyCode;
            c = String.fromCharCode(b).toLowerCase();
            if (b === d || c.match(/x|o|c/)) {
                this.end()
            } else if (c === 'p' || b === e) {
                if (this.currentImageIndex !== 0) {
                    this.changeImage(this.currentImageIndex - 1)
                }
            } else if (c === 'n' || b === f) {
                if (this.currentImageIndex !== this.album.length - 1) {
                    this.changeImage(this.currentImageIndex + 1)
                }
            }
        };
        c.prototype.end = function() {
            this.disableKeyboardNav();
            b(window).off("resize", this.sizeOverlay);
            this.$lightbox.fadeOut(this.options.fadeDuration);
            this.$overlay.fadeOut(this.options.fadeDuration);
            return b('select, object, embed').css({
                visibility: "visible"
            })
        };
        return c
    })();
    b(function() {
        var e, b;
        b = new c();
        return e = new d(b)
    })
}).call(this);