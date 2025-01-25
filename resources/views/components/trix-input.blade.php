@props(['id', 'name', 'value' => '', 'toolbar' => null, 'acceptFiles' => false, 'acceptMentions' => false])

<input
    type="hidden"
    name="{{ $name }}"
    id="{{ $id }}_input"
    value="{{ $value }}"
/>

<trix-toolbar
    @class([
        "[&_.trix-button]:bg-white [&_.trix-button.trix-active]:bg-gray-300",
        "[&>.trix-button-row>.trix-button-group:not(.trix-button-group--text-tools)]:hidden [&_.trix-button--icon-strike]:hidden" => $toolbar === 'mini',
    ])
    id="{{ $id }}_toolbar"
></trix-toolbar>

<trix-editor
    id="{{ $id }}"
    toolbar="{{ $id }}_toolbar"
    input="{{ $id }}_input"
    x-data="{
        init() {
            @if ($acceptMentions)
            const tribute = new Tribute({
                allowSpaces: true,
                lookup: 'name',
                values: this.fetchMentions.bind(this),
            })
            tribute.attach(this.$el)
            tribute.range.pasteHtml = this.pasteHtmlOnTribute.bind(this)
            @endif
        },
        fetchMentions(text, callback) {
            fetch(`/mentions?search=${text}`)
                .then(resp => resp.json())
                .then(users => callback(users))
                .catch(() => callback([]))
        },
        pasteHtmlOnTribute(html, startPosition, endPosition) {
            let range = this.$el.editor.getSelectedRange()
            let position = range[0]
            let length = endPosition - startPosition
            this.$el.editor.setSelectedRange([position - length, position])
            this.$el.editor.deleteInDirection('backward')
        },
        addMention({ detail: { item: { original }}}) {
            this.$el.editor.insertAttachment(new Trix.Attachment({
                ...original,
                content: original.content.trim()
            }))
            this.$el.editor.insertString(' ')
        },
        uploadAttachment(event) {
            if (! event.attachment?.file) return

            const form = new FormData()
            form.append('attachment', event.attachment.file)

            fetch('/attachments', {
                method: 'POST',
                body: form,
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content,
                }
            }).then(resp => resp.json()).then((data) => {
                event.attachment.setAttributes({
                    url: data.attachment_url,
                    href: data.attachment_url,
                })
            }).catch(() => event.attachment.remove())
        }
    }"
    @if ($acceptFiles)
    x-on:trix-attachment-add="uploadAttachment"
    @else
    x-on:trix-file-accept.prevent
    x-on:trix-attachment-add="$event.attachment.file && $event.attachment.remove()"
    @endif
    @if ($acceptMentions)
    x-on:tribute-replaced="addMention"
    @endif
    {{ $attributes->merge(['class' => 'trix-content border-gray-300 dark:bg-gray-900 dark:border-gray-700 dark:!text-white focus:ring-1 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}
></trix-editor>
