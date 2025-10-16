export function initPe() {
  // Enable Bootstrap tooltips (optional)
  if (window.bootstrap) {
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
      new window.bootstrap.Tooltip(el);
    });
  }

  // Flag to prevent recursive auto-save triggers
  let isTriggering = false;

  // Clicks within any PE section (section-level buttons)
  document.addEventListener('click', e => {
    const btn = e.target.closest('[data-pe-action]');
    if (!btn) return;
    const action = btn.getAttribute('data-pe-action');
    const sectionEl = btn.closest('[data-pe-section]');
    if (!sectionEl) return;

    if (action === 'check-all-normal') {
      sectionEl.querySelectorAll('[data-pe-normal]').forEach(n => {
        n.checked = true;
        const row = n.closest('tr');
        // Uncheck all abnormals in this row
        row.querySelectorAll('[data-pe-abnormal]').forEach(a => {
          a.checked = false;
          // Remove detail inputs when unchecking
          const parent = a.closest('.col-12');
          if (parent) {
            parent
              .querySelectorAll('[data-pe-detail], [data-pe-other-text]')
              .forEach(d => d.remove());
          }
        });
      });
      triggerAutoSave();
    }
  });

  // Changes bubbling from any row
  document.addEventListener('change', e => {
    // Prevent recursive auto-save loops
    if (isTriggering) return;

    const row = e.target.closest('tr[data-pe-row]');
    if (!row) return;

    // Normal toggled
    if (e.target.matches('[data-pe-normal]')) {
      if (e.target.checked) {
        // Uncheck abnormals + remove details
        row.querySelectorAll('[data-pe-abnormal]').forEach(a => {
          a.checked = false;
          // Remove detail inputs when unchecking
          const parent = a.closest('.col-12');
          if (parent) {
            parent
              .querySelectorAll('[data-pe-detail], [data-pe-other-text]')
              .forEach(d => d.remove());
          }
        });
      }
      triggerAutoSave();
      return;
    }

    // Abnormal toggled
    if (e.target.matches('[data-pe-abnormal]')) {
      // If any abnormal checked, uncheck Normal
      const anyChecked = row.querySelector('[data-pe-abnormal]:checked');
      const normal = row.querySelector('[data-pe-normal]');
      if (normal) normal.checked = !anyChecked;

      // Handle detail field lazily
      const opt = e.target;
      const needsDetail = opt.getAttribute('data-needs-detail') === '1';
      const isOther = opt.getAttribute('data-is-other') === '1';
      const optionKey = opt.value;
      const parent = opt.closest('.col-12');
      const baseName = buildBaseName(row);

      if (opt.checked) {
        if (isOther) {
          // Add "Other" text input if it doesn't exist
          let existing = parent.querySelector('[data-pe-other-text]');
          if (!existing) {
            const tpl = row.querySelector('template[data-pe-other-template]');
            if (tpl) {
              const node = tpl.content.firstElementChild.cloneNode(true);
              const input = node.querySelector('input');
              input.name = `${baseName}[other_text]`;
              parent.appendChild(node);
            }
          }
        } else if (needsDetail) {
          // Add detail input if it doesn't exist
          let existing = parent.querySelector(`[data-pe-detail][for-option="${optionKey}"]`);
          if (!existing) {
            const tpl = row.querySelector('template[data-pe-detail-template]');
            if (tpl) {
              const node = tpl.content.firstElementChild.cloneNode(true);
              node.setAttribute('for-option', optionKey);
              const input = node.querySelector('input');
              input.name = `${baseName}[detail][${optionKey}]`;
              input.placeholder = `Additional info for '${labelFor(opt)}'`;
              parent.appendChild(node);
            }
          }
        }
      } else {
        // Remove detail input when unchecked
        if (isOther) {
          parent.querySelectorAll('[data-pe-other-text]').forEach(d => d.remove());
        } else {
          parent
            .querySelectorAll(`[data-pe-detail][for-option="${optionKey}"]`)
            .forEach(d => d.remove());
        }
      }

      triggerAutoSave();
      return;
    }
  });

  // initial sync (for edit/old())
  document.querySelectorAll('tr[data-pe-row]').forEach(syncRow);

  function syncRow(row) {
    const anyAbn = row.querySelector('[data-pe-abnormal]:checked');
    const normal = row.querySelector('[data-pe-normal]');
    if (normal) normal.checked = !anyAbn;
  }

  function labelFor(input) {
    const id = input.id;
    const label = id ? rowOf(input).querySelector(`label[for="${id}"]`) : null;
    return label ? label.textContent.trim() : input.value;
  }

  function rowOf(el) {
    return el.closest('tr[data-pe-row]');
  }

  function buildBaseName(row) {
    // Extract base from the "normal" input name
    const normal = row.querySelector('[data-pe-normal]');
    const name = normal?.getAttribute('name') || '';
    // converts name like `pe[general_survey][breathing][normal]` -> `pe[general_survey][breathing]`
    return name.replace(/\[normal\]$/, '');
  }

  function triggerAutoSave() {
    // Dispatch a custom event to trigger jQuery auto-save without causing recursive loops
    const form = document.querySelector('#masterPhysicalExamForm');
    if (form) {
      // Set flag to prevent recursive calls
      isTriggering = true;

      // Use jQuery to trigger the auto-save directly
      if (window.jQuery) {
        window.jQuery(form).find('input[type="checkbox"]').first().trigger('change');
      }

      // Reset flag after a brief delay
      setTimeout(() => {
        isTriggering = false;
      }, 10);
    }
  }
}

document.addEventListener('DOMContentLoaded', initPe);
