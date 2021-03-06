"use strict";
! function() {
    Vue.component("keyboard", {
        template: '<div class="vue-keyboard" role="application" :class="{ full: full, empty: empty }" :data-value="value" :data-layout="layout">\n\t\t\t<div role="row" class="row" v-for="row in buttons" :data-keys="row.length">\n\t\t\t\t<button\n\t\t\t\t\tv-for="btn in row"\n\t\t\t\t\trole="button"\n\t\t\t\t\t:class="btn.type"\n\t\t\t\t\t:data-args="btn.args"\n\t\t\t\t\t:data-text="btn.value"\n\t\t\t\t\t:data-action="btn.action.name"\n\t\t\t\t\t@click.prevent="btn.action.callable"\n\t\t\t\t>{{ btn.value }}</button>\n\t\t\t</div>\n\t\t</div>',
        props: {
            layouts: { type: [String, Array], required: !0 },
            maxlength: {
                type: Number,
                "default": 0,
                validator: function(t) {
                    return t >= 0
                }
            }
        },
        data: function() {
            return { value: "", layout: 0 }
        },
        computed: {
            full: function() {
                return this.value.length >= this.maxlength
            },
            empty: function() {
                return 0 === this.value.length
            },
            buttons: function() {
                var t = this,
                    a = (Array.isArray(this.layouts) ? this.layouts : [this.layouts])[this.layout].split("|");
                return a.map(function(a) {
                    var e = a.split(""),
                        n = [],
                        l = null;
                    return e.forEach(function(a) {
                        if ("{" === a) l = "";
                        else if ("}" === a) {
                            var e = l.split(":"),
                                i = e.length > 1 ? e[0] : "",
                                u = e.length > 1 ? e[1] : e[0],
                                s = e.length > 2 ? e[2] : null,
                                o = null;
                            o = ["append", "backspace", "space", "clear", "goto"].indexOf(u) >= 0 ? t[u].bind(t, s) : t.$emit.bind(t, u, t), n.push({ type: "action", action: { name: u.replace(/\s+/g, "-").toLowerCase(), callable: o }, value: i, args: s }), l = null
                        } else null !== l ? l += a : n.push({ type: "char", action: { name: null, callable: t.append.bind(t, a) }, value: a, args: null })
                    }), n
                })
            }
        },
        methods: {
            mutate: function(t) { this.value = t, this.maxlength > 0 && (this.value = this.value.slice(0, this.maxlength)), this.$emit("input", this.value) },
            append: function(t) { this.mutate(this.value + t) },
            backspace: function() { this.mutate(this.value.slice(0, this.value.length - 1)) },
            space: function() { this.append(" ") },
            "goto": function(t) {
                if (!Array.isArray(this.layouts)) throw new Error("A single non-array layout was provided.");
                if (!(t >= 0 && t < this.layouts.length)) throw new Error("The requested layout does not exist.");
                this.layout = t
            },
            clear: function() { this.mutate("") }
        }
    })
}();
