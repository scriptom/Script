jQuery.fn.manageRows = function (options) {
    options = jQuery.extend({
        row: this.children('[data-rowtab]').first(),
        action: 'append',
        copy: false
    }, options);
    var rowtab = options.row.data('rowtab');
    var counterInput = jQuery(`input[type=hidden][name~=${rowtab}_rowcount]`);
    var numrows = counterInput.length ? parseInt(counterInput.val())
                : options.row.parent().children(options.row).size();
    console.log(numrows);
    if (options.action == 'append') {
        let newRow = options.row.clone(!options.copy);
        newRow.find(`[id|=${rowtab}], [for|=${rowtab}], [data-deletes]`)
            .each((index, el) => {
                if (jQuery(el).attr('name') && jQuery(el).attr('name').match(/\[\d+\]/g)) {
                        jQuery(el).attr('name', (i, e) => e.replace(/(?!\[)\d+(?=\])/g, numrows));
                    }
                if (jQuery(el).is('input, textarea'))
                    jQuery(el).val('');
                if (jQuery(el).attr('id'))
                    jQuery(el).attr('id', (i,e)=>e.replace(/\d+/, numrows + 1));
                else if (jQuery(el).attr('for'))
                    jQuery(el).attr('for', (i,e)=>e.replace(/\d+/, numrows + 1));
                else if (jQuery(el).attr('data-deletes'))
                    jQuery(el).attr('data-deletes', (i,e)=>e.replace(/\d+/, numrows + 1));
                });
        newRow.attr('id', (i,e)=>e.replace(/\d+/, numrows + 1));
        this.append(newRow);
        // if (counterInput.length)
        //     counterInput.val(numrows+1);
        // else { 
        //     counterInput = jQuery("<input>", {
        //         type: 'hidden',
        //         name: `${rowtab}_rowcount`,
        //         value: numrows+1
        //     });
        //     this.prepend(counterInput);
        // }
    } else
    if (options.action == 'remove' && numrows-1) {
        options.row.remove();
        this.children('[data-rowtab]')
            .each((ind, el) => {
                jQuery(el)
                .find(`[id|=${rowtab}], [for|=${rowtab}], [data-deletes]`)
                .each((index, el) => {
                    if (jQuery(el).attr('name') && jQuery(el).attr('name').match(/\[\d+\]/g)) {
                        jQuery(el).attr('name', (i, e) => e.replace(/(?!\[)\d+(?=\])/g, ind));
                    }
                    if (jQuery(el).attr('id'))
                        jQuery(el).attr('id', (i,e)=>e.replace(/\d+/, ind + 1));
                    else if (jQuery(el).attr('for'))
                        jQuery(el).attr('for', (i,e)=>e.replace(/\d+/, ind + 1));
                    else if (jQuery(el).attr('data-deletes'))
                        jQuery(el).attr('data-deletes', (i,e)=>e.replace(/\d+/, ind + 1));
                });
                jQuery(el).attr('id', (i,v)=>v.replace(/\d+/, ind+1));
                
            });
        // if (counterInput.length)
        //     counterInput.val(numrows-1);
        // else { 
        //     counterInput = jQuery("<input>", {
        //         type: 'hidden',
        //         name: `${rowtab}_rowcount`,
        //         value: numrows-1
        //     });
        //     this.prepend(counterInput);
        // }
    }
    return this;
}