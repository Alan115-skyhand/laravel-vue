<footer id="footer">
	<p class="copyright">© 2020 nuriemon ZOTMAN inc.</p>
</footer>
<script src="{{ mix('js/app.js') }}"></script>
{{-- <script src="/public/js/vue.js"></script>
<script src="/public/js/ofi.js"></script> --}}
<!-- vue.datepicker -->
<script src="https://unpkg.com/vuejs-datepicker"></script>
<script src="https://cdn.jsdelivr.net/npm/vuejs-datepicker@1.6.2/dist/locale/translations/ja.js"></script>
<!-- クリップボードにコピーするライブラリ -->
<script src="https://cdn.jsdelivr.net/npm/vue-clipboard2@0.3.1/dist/vue-clipboard.min.js"></script>


{{-- <script>
	objectFitImages();
</script> --}}
<script>
	


	var app = new Vue({
		el: '#app',
		components: {
			'vuejs-datepicker':vuejsDatepicker,
		},
		data() {
			return {
				// カレンダー機能まわり
				ja: vdp_translation_ja.js,
				DatePickerFormat: 'yyyy年MM月dd日',
				// 検索のモーダル
				isSearchActive: false,
				// 新規仮設の現場未確定かどうか
				isNewWorkDateDecide: false,
				// 見積書・請求書の詳細
				isInvoiceActive: false,
				// モーダル
				isModalTrash: false,
				isModalConfirm: false,
				isModalComplete: false,
				isModalInvoiceAdd: false,
				// 銀行口座
				isBankEdit: false,
				// 営業担当
				isMemberEdit: false,
				// 職人
				isWorkerEdit: false,
				// お客様
				isClientEdit: false,
				// 職人の質問
				isWorkerTypeQuestion: false,
				// 現場入力フォーム
				field1: '',
				field2: '',
				field3: '',
				field4: '',
				field5: '',
				field6: '',
				field7: '',
				// 現場入力フォーム
				process1: '',
				process2: '',
				process3: '',
				process4: '',
				// タブ切り替え
				panelActive: '1',
				// 見積書項目
				unitNumber: 0,
				unitPrice: 0,
				workerId: 'Copy These Text',
			}
		},
		computed: {
			// 現場の必須項目を全て入力するとsubmitできる
			form_all: function() {
				let required_fields = [
					this.field5,
					this.field6,
					this.field7,
				]
				if(this.field1 || this.field3 && this.field2 || this.field4) {
					return required_fields.indexOf('') === -1
				}
			},
			// 項目の必須項目を全て入力するとsubmitできる
			proccess_all: function() {
				let required_fields = [
					this.process1,
					this.process2,
					this.process3,
					this.process4,
				]
				return required_fields.indexOf('') === -1
			},
			sum: function() {
				return this.unitNumber * this.unitPrice
			},
		},
		methods: {
			// 検索のモーダル
			toggleSearchActive: function() {
				this.isSearchActive = !this.isSearchActive;
			},
			// 詳細のモーダル
			// 案件詳細の切り替え
			toggleWorkDateDecide: function() {
				this.field1 = '';
				this.field2 = '';
				this.field3 = '';
				this.field4 = '';
				this.isNewWorkDateDecide = !this.isNewWorkDateDecide;
			},
			// パネルの切り替え
			changePanel: function(num) {
				this.panelActive = num
			},
			toggleModalTrush: function() {
				this.isModalTrash = !this.isModalTrash
			},
			toggleModalConfirm: function() {
				this.isModalConfirm = !this.isModalConfirm
			},
			toggleModalComplete: function() {
				this.isModalComplete = !this.isModalComplete
			},
			toggleInvoiceActive: function() {
				this.isInvoiceActive = !this.isInvoiceActive
			},
			toggleModalInvoiceAdd: function() {
				this.isModalInvoiceAdd = !this.isModalInvoiceAdd
			},
			// バリデーション：半角数字のみ＋先頭の数字を0以外にする
			validateUnit: function() {
				this.unitNumber = parseInt(this.unitNumber.replace(/\D/g, ''), 10)
			},
			validatePrice: function() {
				this.unitNumber = parseInt(this.unitNumber.replace(/\D/g, ''), 10)
			},
			// 銀行口座のtoggle
			toggleBankEdit: function() {
				this.isBankEdit = !this.isBankEdit
			},
			// 銀行口座のtoggle
			toggleBankEdit: function() {
				this.isBankEdit = !this.isBankEdit
			},
			// 銀行口座のtoggle
			toggleBankEdit: function() {
				this.isBankEdit = !this.isBankEdit
			},
			// 銀行口座のtoggle
			toggleMemberEdit: function() {
				this.isMemberEdit = !this.isMemberEdit
			},
			// 銀行口座のtoggle
			toggleWorkerEdit: function() {
				this.isWorkerEdit = !this.isWorkerEdit
			},
			// 銀行口座のtoggle
			toggleClientEdit: function() {
				this.isClientEdit = !this.isClientEdit
			},
			// コピーする
			onCopy: function (e) {
				alert('「' + e.text + '」をコピーしました')
			},
			onError: function (e) {
				alert('Failed to copy texts')
			},
			// 職人のタイプ質問
			toggleWorkerTypeQuestion: function() {
				this.isWorkerTypeQuestion = !this.isWorkerTypeQuestion
			}
		},
		watch: {

		},
		mounted() {
			console.log(window.location);
			const tab = window.location.href.split("/").pop();
			console.log(tab);
			switch (tab) {
				case "work":
					this.tab_num = 1; break;
				case "client":
					this.tab_num = 3; break;
				case "worker":
					this.tab_num = 2; break;
				case "document":
					this.tab_num = 4; break;
				default:
					this.tab_num = 1
			}
			console.log(this.tab_num);
			$("#header-user > div.header-user__top > div > div > div.header-user__top__search.c-search--box.l-inputLabel").on('click', (e) => {
				if (e.offsetX > e.target.offsetLeft) {
					// click on element
				}
				else{
					// click on ::before element
					$cookies.set('searchKey',$(e.target).children("input").val());
					$cookies.set('tab',this.tab_num);
					document.location = "/user/search"
				}
			});
			$("#header-user > div.header-user__top > div > div > div.header-user__top__search.c-search--box.l-inputLabel > input").on('keypress', (e) => {
				if (e.key === 'Enter' || e.keyCode === 13) {
					// click on ::before element
					$cookies.set('searchKey', $(e.target).val());
					$cookies.set('tab',this.tab_num);
					console.log($(e.target).val());
					document.location = "/user/search"
				}
			});
		},
	})

	
</script>