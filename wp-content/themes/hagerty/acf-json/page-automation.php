[
  {
    "key": "group_auto_services_page",
    "title": "Automation Services Page",
    "fields": [
      {
        "key": "field_auto_tab_hero",
        "label": "Hero",
        "name": "",
        "type": "tab",
        "placement": "top",
        "endpoint": 0
      },
      {
        "key": "field_auto_hero_label",
        "label": "Hero Label",
        "name": "auto_hero_label",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_hero_heading_line_1",
        "label": "Hero Heading Line 1",
        "name": "auto_hero_heading_line_1",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_hero_heading_line_2",
        "label": "Hero Heading Line 2",
        "name": "auto_hero_heading_line_2",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_hero_description",
        "label": "Hero Description",
        "name": "auto_hero_description",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_hero_background_type",
        "label": "Hero Background Type",
        "name": "auto_hero_background_type",
        "type": "select",
        "choices": {
          "none": "None",
          "image": "Image",
          "video": "Video"
        },
        "default_value": "none",
        "allow_null": 0,
        "multiple": 0,
        "ui": 1,
        "ajax": 0,
        "return_format": "value",
        "placeholder": ""
      },
      {
        "key": "field_auto_hero_background_image",
        "label": "Hero Background Image",
        "name": "auto_hero_background_image",
        "type": "image",
        "return_format": "array",
        "preview_size": "medium",
        "library": "all",
        "min_width": "",
        "min_height": "",
        "min_size": "",
        "max_width": "",
        "max_height": "",
        "max_size": "",
        "mime_types": ""
      },
      {
        "key": "field_auto_hero_background_video_mp4",
        "label": "Hero Background Video (MP4)",
        "name": "auto_hero_background_video_mp4",
        "type": "file",
        "return_format": "array",
        "library": "all",
        "min_size": "",
        "max_size": "",
        "mime_types": "mp4"
      },
      {
        "key": "field_auto_hero_background_video_webm",
        "label": "Hero Background Video (WEBM)",
        "name": "auto_hero_background_video_webm",
        "type": "file",
        "return_format": "array",
        "library": "all",
        "min_size": "",
        "max_size": "",
        "mime_types": "webm"
      },
      {
        "key": "field_auto_hero_background_video_poster",
        "label": "Hero Video Poster",
        "name": "auto_hero_background_video_poster",
        "type": "image",
        "return_format": "array",
        "preview_size": "medium",
        "library": "all",
        "mime_types": ""
      },
      {
        "key": "field_auto_hero_background_overlay_opacity",
        "label": "Hero Overlay Opacity",
        "name": "auto_hero_background_overlay_opacity",
        "type": "number",
        "default_value": 0.5,
        "min": 0,
        "max": 1,
        "step": 0.1,
        "prepend": "",
        "append": ""
      },
      {
        "key": "field_auto_hero_primary_button",
        "label": "Hero Primary Button",
        "name": "auto_hero_primary_button",
        "type": "link",
        "return_format": "array"
      },
      {
        "key": "field_auto_hero_secondary_button",
        "label": "Hero Secondary Button",
        "name": "auto_hero_secondary_button",
        "type": "link",
        "return_format": "array"
      },

      {
        "key": "field_auto_tab_stats",
        "label": "Stats",
        "name": "",
        "type": "tab",
        "placement": "top",
        "endpoint": 0
      },
      {
        "key": "field_auto_stats",
        "label": "Stats",
        "name": "auto_stats",
        "type": "repeater",
        "instructions": "Repeater of stat items (number + label).",
        "required": 0,
        "min": 0,
        "max": 0,
        "layout": "table",
        "button_label": "Add Stat",
        "sub_fields": [
          {
            "key": "field_auto_stats_number",
            "label": "Number",
            "name": "number",
            "type": "wysiwyg",
            "tabs": "visual",
            "toolbar": "basic",
            "media_upload": 0,
            "delay": 0
          },
          {
            "key": "field_auto_stats_label",
            "label": "Label",
            "name": "label",
            "type": "wysiwyg",
            "tabs": "visual",
            "toolbar": "basic",
            "media_upload": 0,
            "delay": 0
          }
        ]
      },

      {
        "key": "field_auto_tab_info_1",
        "label": "Info Section 1 (What is Automation)",
        "name": "",
        "type": "tab",
        "placement": "top",
        "endpoint": 0
      },
      {
        "key": "field_auto_what_is_heading_line1",
        "label": "Heading Line 1",
        "name": "auto_what_is_heading_line1",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_what_is_heading_line2",
        "label": "Heading Line 2",
        "name": "auto_what_is_heading_line2",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_what_is_content",
        "label": "Content",
        "name": "auto_what_is_content",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "full",
        "media_upload": 1,
        "delay": 0
      },
      {
        "key": "field_auto_what_is_image",
        "label": "Image",
        "name": "auto_what_is_image",
        "type": "image",
        "return_format": "array",
        "preview_size": "medium",
        "library": "all"
      },
      {
        "key": "field_auto_what_is_button",
        "label": "Button",
        "name": "auto_what_is_button",
        "type": "link",
        "return_format": "array"
      },

      {
        "key": "field_auto_tab_longcta_1",
        "label": "Long CTA 1",
        "name": "",
        "type": "tab",
        "placement": "top",
        "endpoint": 0
      },
      {
        "key": "field_auto_long_cta1_label",
        "label": "Label",
        "name": "auto_long_cta1_label",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_long_cta1_heading_line1",
        "label": "Heading Line 1",
        "name": "auto_long_cta1_heading_line_1",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_long_cta1_heading_line2",
        "label": "Heading Line 2",
        "name": "auto_long_cta1_heading_line_2",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_long_cta1_text",
        "label": "Text",
        "name": "auto_long_cta1_text",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_long_cta1_features",
        "label": "Features",
        "name": "auto_long_cta1_features",
        "type": "repeater",
        "layout": "row",
        "button_label": "Add Feature",
        "sub_fields": [
          {
            "key": "field_auto_long_cta1_feature_icon_svg",
            "label": "Icon SVG",
            "name": "icon_svg",
            "type": "textarea",
            "rows": 6,
            "new_lines": ""
          },
          {
            "key": "field_auto_long_cta1_feature_title",
            "label": "Title",
            "name": "title",
            "type": "wysiwyg",
            "tabs": "visual",
            "toolbar": "basic",
            "media_upload": 0,
            "delay": 0
          },
          {
            "key": "field_auto_long_cta1_feature_description",
            "label": "Description",
            "name": "description",
            "type": "wysiwyg",
            "tabs": "visual",
            "toolbar": "basic",
            "media_upload": 0,
            "delay": 0
          }
        ]
      },
      {
        "key": "field_auto_long_cta1_primary_button",
        "label": "Primary Button",
        "name": "auto_long_cta1_primary_button",
        "type": "link",
        "return_format": "array"
      },
      {
        "key": "field_auto_long_cta1_secondary_button",
        "label": "Secondary Button",
        "name": "auto_long_cta1_secondary_button",
        "type": "link",
        "return_format": "array"
      },

      {
        "key": "field_auto_tab_services",
        "label": "Services",
        "name": "",
        "type": "tab",
        "placement": "top",
        "endpoint": 0
      },
      {
        "key": "field_auto_services_label",
        "label": "Services Label",
        "name": "auto_services_label",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_services_heading",
        "label": "Services Heading",
        "name": "auto_services_heading",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_services_subheading",
        "label": "Services Subheading",
        "name": "auto_services_subheading",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_services",
        "label": "Services (Cards)",
        "name": "auto_services",
        "type": "repeater",
        "layout": "row",
        "button_label": "Add Service",
        "sub_fields": [
          {
            "key": "field_auto_service_title",
            "label": "Title",
            "name": "title",
            "type": "wysiwyg",
            "tabs": "visual",
            "toolbar": "basic",
            "media_upload": 0,
            "delay": 0
          },
          {
            "key": "field_auto_service_description",
            "label": "Description",
            "name": "description",
            "type": "wysiwyg",
            "tabs": "visual",
            "toolbar": "basic",
            "media_upload": 0,
            "delay": 0
          },
          {
            "key": "field_auto_service_icon_svg",
            "label": "Icon SVG",
            "name": "icon_svg",
            "type": "textarea",
            "rows": 6,
            "new_lines": ""
          }
        ]
      },

      {
        "key": "field_auto_tab_info_2",
        "label": "Info Section 2 (Why Automate)",
        "name": "",
        "type": "tab",
        "placement": "top",
        "endpoint": 0
      },
      {
        "key": "field_auto_why_automate_heading_line1",
        "label": "Heading Line 1",
        "name": "auto_why_automate_heading_line1",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_why_automate_heading_line2",
        "label": "Heading Line 2",
        "name": "auto_why_automate_heading_line2",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_why_automate_content",
        "label": "Content",
        "name": "auto_why_automate_content",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "full",
        "media_upload": 1,
        "delay": 0
      },
      {
        "key": "field_auto_why_automate_image",
        "label": "Image",
        "name": "auto_why_automate_image",
        "type": "image",
        "return_format": "array",
        "preview_size": "medium",
        "library": "all"
      },
      {
        "key": "field_auto_why_automate_button",
        "label": "Button",
        "name": "auto_why_automate_button",
        "type": "link",
        "return_format": "array"
      },

      {
        "key": "field_auto_tab_longcta_2",
        "label": "Long CTA 2 (Simple)",
        "name": "",
        "type": "tab",
        "placement": "top",
        "endpoint": 0
      },
      {
        "key": "field_auto_long_cta2_label",
        "label": "Label",
        "name": "auto_long_cta2_label",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_long_cta2_heading_line1",
        "label": "Heading Line 1",
        "name": "auto_long_cta2_heading_line1",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_long_cta2_heading_line2",
        "label": "Heading Line 2",
        "name": "auto_long_cta2_heading_line2",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_long_cta2_text",
        "label": "Text",
        "name": "auto_long_cta2_text",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_long_cta2_primary_button",
        "label": "Primary Button",
        "name": "auto_long_cta2_primary_button",
        "type": "link",
        "return_format": "array"
      },
      {
        "key": "field_auto_long_cta2_secondary_button",
        "label": "Secondary Button",
        "name": "auto_long_cta2_secondary_button",
        "type": "link",
        "return_format": "array"
      },

      {
        "key": "field_auto_tab_process",
        "label": "Process",
        "name": "",
        "type": "tab",
        "placement": "top",
        "endpoint": 0
      },
      {
        "key": "field_auto_process_label",
        "label": "Process Label",
        "name": "auto_process_label",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_process_heading",
        "label": "Process Heading",
        "name": "auto_process_heading",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_process_subheading",
        "label": "Process Subheading",
        "name": "auto_process_subheading",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_process_steps",
        "label": "Process Steps",
        "name": "auto_process_steps",
        "type": "repeater",
        "layout": "row",
        "button_label": "Add Step",
        "sub_fields": [
          {
            "key": "field_auto_process_step_title",
            "label": "Title",
            "name": "title",
            "type": "wysiwyg",
            "tabs": "visual",
            "toolbar": "basic",
            "media_upload": 0,
            "delay": 0
          },
          {
            "key": "field_auto_process_step_description",
            "label": "Description",
            "name": "description",
            "type": "wysiwyg",
            "tabs": "visual",
            "toolbar": "basic",
            "media_upload": 0,
            "delay": 0
          }
        ]
      },

      {
        "key": "field_auto_tab_info_3",
        "label": "Info Section 3 (Tools & Integrations)",
        "name": "",
        "type": "tab",
        "placement": "top",
        "endpoint": 0
      },
      {
        "key": "field_auto_tools_heading_line1",
        "label": "Heading Line 1",
        "name": "auto_tools_heading_line1",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_tools_heading_line2",
        "label": "Heading Line 2",
        "name": "auto_tools_heading_line2",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_tools_content",
        "label": "Content",
        "name": "auto_tools_content",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "full",
        "media_upload": 1,
        "delay": 0
      },
      {
        "key": "field_auto_tools_image",
        "label": "Image",
        "name": "auto_tools_image",
        "type": "image",
        "return_format": "array",
        "preview_size": "medium",
        "library": "all"
      },
      {
        "key": "field_auto_tools_button",
        "label": "Button",
        "name": "auto_tools_button",
        "type": "link",
        "return_format": "array"
      },

      {
        "key": "field_auto_tab_longcta_3",
        "label": "Long CTA 3",
        "name": "",
        "type": "tab",
        "placement": "top",
        "endpoint": 0
      },
      {
        "key": "field_auto_long_cta3_label",
        "label": "Label",
        "name": "auto_long_cta3_label",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_long_cta3_heading_line1",
        "label": "Heading Line 1",
        "name": "auto_long_cta3_heading_line1",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_long_cta3_heading_line2",
        "label": "Heading Line 2",
        "name": "auto_long_cta3_heading_line2",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_long_cta3_text",
        "label": "Text",
        "name": "auto_long_cta3_text",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_long_cta3_features",
        "label": "Features",
        "name": "auto_long_cta3_features",
        "type": "repeater",
        "layout": "row",
        "button_label": "Add Feature",
        "sub_fields": [
          {
            "key": "field_auto_long_cta3_feature_icon_svg",
            "label": "Icon SVG",
            "name": "icon_svg",
            "type": "textarea",
            "rows": 6,
            "new_lines": ""
          },
          {
            "key": "field_auto_long_cta3_feature_title",
            "label": "Title",
            "name": "title",
            "type": "wysiwyg",
            "tabs": "visual",
            "toolbar": "basic",
            "media_upload": 0,
            "delay": 0
          },
          {
            "key": "field_auto_long_cta3_feature_description",
            "label": "Description",
            "name": "description",
            "type": "wysiwyg",
            "tabs": "visual",
            "toolbar": "basic",
            "media_upload": 0,
            "delay": 0
          }
        ]
      },
      {
        "key": "field_auto_long_cta3_primary_button",
        "label": "Primary Button",
        "name": "auto_long_cta3_primary_button",
        "type": "link",
        "return_format": "array"
      },
      {
        "key": "field_auto_long_cta3_secondary_button",
        "label": "Secondary Button",
        "name": "auto_long_cta3_secondary_button",
        "type": "link",
        "return_format": "array"
      },

      {
        "key": "field_auto_tab_results",
        "label": "Results",
        "name": "",
        "type": "tab",
        "placement": "top",
        "endpoint": 0
      },
      {
        "key": "field_auto_results_label",
        "label": "Results Label",
        "name": "auto_results_label",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_results_heading",
        "label": "Results Heading",
        "name": "auto_results_heading",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_results_subheading",
        "label": "Results Subheading",
        "name": "auto_results_subheading",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_results",
        "label": "Results Items",
        "name": "auto_results",
        "type": "repeater",
        "layout": "row",
        "button_label": "Add Result",
        "sub_fields": [
          {
            "key": "field_auto_result_industry",
            "label": "Industry",
            "name": "industry",
            "type": "wysiwyg",
            "tabs": "visual",
            "toolbar": "basic",
            "media_upload": 0,
            "delay": 0
          },
          {
            "key": "field_auto_result_title",
            "label": "Title",
            "name": "title",
            "type": "wysiwyg",
            "tabs": "visual",
            "toolbar": "basic",
            "media_upload": 0,
            "delay": 0
          },
          {
            "key": "field_auto_result_description",
            "label": "Description",
            "name": "description",
            "type": "wysiwyg",
            "tabs": "visual",
            "toolbar": "full",
            "media_upload": 1,
            "delay": 0
          },
          {
            "key": "field_auto_result_metric1_value",
            "label": "Metric 1 Value",
            "name": "metric1_value",
            "type": "wysiwyg",
            "tabs": "visual",
            "toolbar": "basic",
            "media_upload": 0,
            "delay": 0
          },
          {
            "key": "field_auto_result_metric1_label",
            "label": "Metric 1 Label",
            "name": "metric1_label",
            "type": "wysiwyg",
            "tabs": "visual",
            "toolbar": "basic",
            "media_upload": 0,
            "delay": 0
          },
          {
            "key": "field_auto_result_metric2_value",
            "label": "Metric 2 Value",
            "name": "metric2_value",
            "type": "wysiwyg",
            "tabs": "visual",
            "toolbar": "basic",
            "media_upload": 0,
            "delay": 0
          },
          {
            "key": "field_auto_result_metric2_label",
            "label": "Metric 2 Label",
            "name": "metric2_label",
            "type": "wysiwyg",
            "tabs": "visual",
            "toolbar": "basic",
            "media_upload": 0,
            "delay": 0
          },
          {
            "key": "field_auto_result_image",
            "label": "Image",
            "name": "image",
            "type": "image",
            "return_format": "array",
            "preview_size": "medium",
            "library": "all"
          }
        ]
      },

      {
        "key": "field_auto_tab_faq",
        "label": "FAQ",
        "name": "",
        "type": "tab",
        "placement": "top",
        "endpoint": 0
      },
      {
        "key": "field_auto_faq_label",
        "label": "FAQ Label",
        "name": "auto_faq_label",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_faq_heading",
        "label": "FAQ Heading",
        "name": "auto_faq_heading",
        "type": "wysiwyg",
        "tabs": "visual",
        "toolbar": "basic",
        "media_upload": 0,
        "delay": 0
      },
      {
        "key": "field_auto_faqs",
        "label": "FAQs",
        "name": "auto_faqs",
        "type": "repeater",
        "layout": "row",
        "button_label": "Add FAQ",
        "sub_fields": [
          {
            "key": "field_auto_faq_question",
            "label": "Question",
            "name": "question",
            "type": "wysiwyg",
            "tabs": "visual",
            "toolbar": "basic",
            "media_upload": 0,
            "delay": 0
          },
          {
            "key": "field_auto_faq_answer",
            "label": "Answer",
            "name": "answer",
            "type": "wysiwyg",
            "tabs": "visual",
            "toolbar": "full",
            "media_upload": 1,
            "delay": 0
          }
        ]
      }
    ],
    "location": [
      [
        {
          "param": "page_template",
          "operator": "==",
          "value": "page-automation.php"
        }
      ]
    ],
    "menu_order": 0,
    "position": "normal",
    "style": "default",
    "label_placement": "top",
    "instruction_placement": "label",
    "hide_on_screen": "",
    "active": true,
    "description": "ACF field group for page-automation.php (Automation Services).",
    "show_in_rest": 0
  }
]
