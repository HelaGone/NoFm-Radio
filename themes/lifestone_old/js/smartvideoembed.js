//===============================================
// ------------- smartvimeoembed ----------------
//===============================================
!function(a){function b(b,e){this.element=b,this.options=a.extend({},d,e),this._defaults=d,this._name=c,this.init()}var c="smartVimeoEmbed",d={idSelectorName:"vimeo-id",vimeoPatternUrl:"http://vimeo.com/api/oembed.json?url=http%3A%2F%2Fvimeo.com/",autoplay:!0,width:640,onComplete:function(){},onError:function(){}};b.prototype={init:function(){var b=this.options;a(this.element).each(function(c,d){var e=a(d),f=e.data(b.idSelectorName);if(f&&!/VIMEO/i.test(e.attr("src"))){var g=b.vimeoPatternUrl+f+"&autoplay="+b.autoplay+"&width="+b.width+"&callback=?";a.ajax({url:g,dataType:"jsonp",success:function(c){a("#output").text(JSON.stringify(c)),e.wrap('<div class="vimeo-wrapper" />'),e.attr("src",c.thumbnail_url),e.parent().prepend('<span class="play-icon"/>').on("click",function(){var d=a(this);d.find("iframe").length||d.append(c.html).find("img, .play-icon").hide(),b.onComplete&&"function"==typeof b.onComplete&&b.onComplete.call(this)})},error:function(){b.onError&&"function"==typeof b.onError&&b.onError.call(this)}})}})}},a.fn[c]=function(d){return this.each(function(){a.data(this,"plugin_"+c)||a.data(this,"plugin_"+c,new b(this,d))})}}(jQuery,window,document);