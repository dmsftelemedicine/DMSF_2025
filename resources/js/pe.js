export function initPe() {
  // Enable Bootstrap tooltips (optional)
  if (window.bootstrap) {
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
      new window.bootstrap.Tooltip(el);
    });
  }

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
        row.querySelectorAll('[data-pe-abnormal]').forEach(a => (a.checked = false));
        // Remove all detail inputs
        row.querySelectorAll('[data-pe-detail],[data-pe-other-text]').forEach(el => el.remove());
      });
      triggerAutoSave();
    }
    if (action === 'uncheck-all-normal') {
      sectionEl.querySelectorAll('[data-pe-normal]').forEach(n => {
        n.checked = false;
      });
      // Note: We don't auto-check abnormals - user must explicitly select them
      triggerAutoSave();
    }
  });

  // Changes bubbling from any row
  document.addEventListener('change', e => {
    const row = e.target.closest('tr[data-pe-row]');
    if (!row) return;

    // Normal toggled
    if (e.target.matches('[data-pe-normal]')) {
      if (e.target.checked) {
        // Uncheck abnormals + remove details
        row.querySelectorAll('[data-pe-abnormal]').forEach(a => (a.checked = false));
        row.querySelectorAll('[data-pe-detail],[data-pe-other-text]').forEach(el => el.remove());
      }
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
      const detailsBox = row.querySelector('[data-pe-detail-container]');
      const baseName = buildBaseName(row);

      if (needsDetail) {
        if (opt.checked) {
          if (isOther) {
            // Other text
            let el = row.querySelector('[data-pe-other-text]');
            if (!el) {
              el = document.createElement('div');
              el.className = 'mb-1';
              el.setAttribute('data-pe-other-text', '');
              el.innerHTML = `<input type="text" class="form-control form-control-sm"
                                   name="${baseName}[other_text]" placeholder="Please specify...">`;
              detailsBox.appendChild(el);
            }
          } else {
            // Clone template for detail
            const tpl = row.querySelector('template[data-pe-detail-template]');
            const node = tpl.content.firstElementChild.cloneNode(true);
            node.setAttribute('for-option', opt.value);
            const input = node.querySelector('input');
            input.name = `${baseName}[detail][${opt.value}]`;
            input.placeholder = `Additional info for '${labelFor(opt)}'`;
            detailsBox.appendChild(node);
          }
        } else {
          // remove fields when unchecked
          if (isOther) {
            const other = row.querySelector('[data-pe-other-text]');
            if (other) other.remove();
          } else {
            const el = row.querySelector(`[data-pe-detail][for-option="${opt.value}"]`);
            if (el) el.remove();
          }
        }
      }
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
    // Trigger change event on first checkbox to activate autosave
    const firstCheckbox = document.querySelector('#masterPhysicalExamForm input[type="checkbox"]');
    if (firstCheckbox) {
      firstCheckbox.dispatchEvent(new Event('change', { bubbles: true }));
    }
  }
}

document.addEventListener('DOMContentLoaded', initPe);
