import{f as k,j as L,u as $,e as R,g as D}from"./index.jlplx4ex.js";import{u as N}from"./vue3-apexcharts.n0h2b4pa.js";import{C as T}from"./Caret.hnvbzqgq.js";import{C as V}from"./Blur.f3nyx4yc.js";import{G as q,a as G}from"./Row.o0q8mn7y.js";import{P as U}from"./PostsTable.o05h3h89.js";import"./translations.b896ab1m.js";import{_ as A}from"./_plugin-vue_export-helper.oebm7xum.js";import{_ as S}from"./default-i18n.hohxoesu.js";import{v as n,o as i,k as l,l as r,a as _,C as a,x as g,t as c,c as x,u as t,b as h}from"./runtime-dom.esm-bundler.h3clfjuw.js";import{C as z}from"./Index.h6ka6vtn.js";import{R as I}from"./RequiredPlans.kyt85n6a.js";import{C as M}from"./Tooltip.jx4casvt.js";import{a as j}from"./index.npoectbv.js";import{u as E}from"./License.gohzo0vr.js";import"./helpers.cti0cl6i.js";import"./PostTypes.pd67gy5m.js";import"./Statistic.kmcuzczi.js";import"./_baseClone.j5qc2kco.js";import"./_arrayEach.n8ou32wp.js";import"./_getTag.fj45ivwn.js";import"./vue-router.eypfdvl5.js";import"./numbers.busvl4mt.js";import"./WpTable.iid7bkmr.js";import"./ScrollTo.ntqtkazp.js";import"./license.d8rszxb2.js";import"./upperFirst.c4ega9c0.js";import"./_stringToArray.mpukyt2g.js";import"./toString.fflnj7pf.js";import"./ScoreButton.br7jqlck.js";import"./Table.dpnj7vzp.js";import"./Slide.dop8j51m.js";import"./IndexStatus.nbccisin.js";import"./CheckSolid.ktze41sq.js";import"./Calendar.fbofsn3b.js";import"./Mobile.livanyta.js";import"./Checkmark.d5kkjaf5.js";import"./ExclamationSolid.jc4spp6p.js";import"./Link.lo5szjwl.js";import"./constants.hcfrsngk.js";import"./addons.b0mmvdz0.js";const B="all-in-one-seo-pack",H={setup(){return{searchStatisticsStore:k()}},components:{CoreAlert:T,CoreBlur:V,GridColumn:q,GridRow:G,PostsTable:U},data(){return{strings:{title:S("Content Rankings",B),alert:S("The Content Rankings report provides valuable insights into the performance of your content in search results and helps you optimize your posts for better results. This report is generated on a monthly basis, covering the past 12 months leading up to the current month. By regularly reviewing this report, you can identify trends in your post rankings and make informed decisions to improve your content's visibility and ultimately increase rankings in search results.",B)},defaultPages:{rows:[],totals:{page:0,pages:0,total:0}}}}},Q={class:"aioseo-search-statistics-content-rankings"},F={class:"aioseo-search-statistics-content-rankings__title"};function J(y,e,p,s,o,b){const u=n("core-alert"),C=n("posts-table"),v=n("grid-column"),w=n("grid-row"),f=n("core-blur");return i(),l(f,null,{default:r(()=>[_("div",Q,[a(w,null,{default:r(()=>[a(v,null,{default:r(()=>{var m,d;return[a(u,{class:"description",type:"blue","show-close":""},{default:r(()=>[g(c(o.strings.alert),1)]),_:1}),_("div",F,[_("h2",null,c(o.strings.title),1)]),a(C,{posts:((d=(m=s.searchStatisticsStore.data)==null?void 0:m.contentRankings)==null?void 0:d.paginated)||o.defaultPages,columns:["postTitle","indexStatus","lastUpdated","loss","drop","performance"],"show-items-per-page":"","show-table-footer":""},null,8,["posts"])]}),_:1})]),_:1})])]),_:1})}const K=A(H,[["render",J]]),O={class:"aioseo-search-statistics-content-rankings"},W={__name:"Index",setup(y){const{strings:e}=N(),p=L(),s=k(),o=$();return(b,u)=>(i(),x("div",O,[t(s).shouldShowSampleReports?h("",!0):(i(),l(t(K),{key:0})),t(s).shouldShowSampleReports?h("",!0):(i(),l(t(z),{key:1,"cta-link":t(R).getPricingUrl("search-statistics","search-statistics-upsell","content-rankings"),"button-text":t(e).ctaButtonText,"learn-more-link":t(R).getUpsellUrl("search-statistics","content-rankings",t(o).isPro?"pricing":"liteUpgrade"),"cta-second-button-action":"",onCtaSecondButtonClick:t(s).showSampleReports,"second-button-text":t(e).ctaSecondButtonText,"cta-second-button-new-badge":"","cta-second-button-visible":"","feature-list":[t(e).feature1,t(e).feature2,t(e).feature3,t(e).feature4],"align-top":"","hide-bonus":!t(p).isUnlicensed},{"header-text":r(()=>[g(c(t(e).ctaHeader),1)]),description:r(()=>[a(t(I),{"core-feature":["search-statistics"]}),g(" "+c(t(e).ctaDescription),1)]),_:1},8,["cta-link","button-text","learn-more-link","onCtaSecondButtonClick","second-button-text","feature-list","hide-bonus"]))]))}},P="all-in-one-seo-pack",X={setup(){return{searchStatisticsStore:k(),settingsStore:D()}},components:{CoreAlert:T,CoreTooltip:M,PostsTable:U,SvgCircleQuestionMark:j},data(){return{strings:{title:S("Content Rankings",P),alert:S("The Content Rankings report provides valuable insights into the performance of your content in search results and helps you optimize your posts for better results. This report is generated on a monthly basis, covering the past 12 months leading up to the current month. By regularly reviewing this report, you can identify trends in your post rankings and make informed decisions to improve your content's visibility and ultimately increase rankings in search results.",P)},defaultPages:{rows:[],totals:{page:0,pages:0,total:0}}}},mounted(){this.searchStatisticsStore.isConnected&&this.searchStatisticsStore.loadInitialData()}},Y={class:"aioseo-search-statistics-content-rankings"},Z={class:"aioseo-search-statistics-content-rankings__title"};function tt(y,e,p,s,o,b){var f,m,d;const u=n("core-alert"),C=n("svg-circle-question-mark"),v=n("core-tooltip"),w=n("posts-table");return i(),x("div",Y,[(f=s.settingsStore.settings.dismissedAlerts)!=null&&f.searchStatisticsContentRankings?h("",!0):(i(),l(u,{key:0,class:"description",type:"blue","show-close":"",onCloseAlert:e[0]||(e[0]=()=>s.settingsStore.dismissAlert("searchStatisticsContentRankings"))},{default:r(()=>[g(c(o.strings.alert),1)]),_:1})),_("div",Z,[_("h2",null,c(o.strings.title),1),a(v,{offset:"200px,0"},{tooltip:r(()=>[g(c(o.strings.alert),1)]),default:r(()=>[a(C)]),_:1})]),a(w,{posts:((d=(m=s.searchStatisticsStore.data)==null?void 0:m.contentRankings)==null?void 0:d.paginated)||o.defaultPages,columns:["postTitleSortable","indexStatus","lastUpdatedSortable","decaySortable","decayPercentSortable","performance"],"default-sorting":{orderBy:"decay",orderDir:"asc"},isLoading:s.searchStatisticsStore.loading.contentRankings,updateAction:"updateContentRankings","show-items-per-page":"","show-table-footer":""},null,8,["posts","isLoading"])])}const et=A(X,[["render",tt]]),st={class:"aioseo-search-statistics-content-rankings"},Ht={__name:"ContentRankings",setup(y){const e=k(),{shouldShowLite:p,shouldShowMain:s,shouldShowUpgrade:o}=E();return(b,u)=>(i(),x("div",st,[t(s)("search-statistics","content-rankings")||t(e).shouldShowSampleReports?(i(),l(t(et),{key:0})):h("",!0),(t(o)("search-statistics","content-rankings")||t(p))&&!t(e).shouldShowSampleReports?(i(),l(t(W),{key:1})):h("",!0)]))}};export{Ht as default};