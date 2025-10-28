import React from 'react';

const JobForm = ({ job = null, onSubmit }) => {
  const handleSubmit = (e) => {
    e.preventDefault();

    const formData = new FormData(e.target);

    onSubmit({
      contact_name: formData.get('contact_name'),
      contact_phone: formData.get('contact_phone'),
      contact_email: formData.get('contact_email'),
      location: formData.get('location'),
      details: formData.get('details'),
    });
  };

  return (
    <form
      onSubmit={handleSubmit}
      className="w-1/2 space-y-4"
    >
      <div className="grid grid-cols-[25%_75%]">
        <label
          htmlFor="contact_name"
          className="px-2 py-2"
        >
          Your name
        </label>
        <input
          type="text"
          id="contact_name"
          name="contact_name"
          defaultValue={job?.contact_name || ''}
          className="border px-2 py-2"
        />
      </div>
      <div className="grid grid-cols-[25%_75%]">
        <label
          htmlFor="contact_phone"
          className="px-2 py-2"
        >
          Your phone number
        </label>
        <input
          type="text"
          id="contact_phone"
          name="contact_phone"
          defaultValue={job?.contact_phone || ''}
          className="border px-2 py-2"
        />
      </div>
      <div className="grid grid-cols-[25%_75%]">
        <label
          htmlFor="contact_email"
          className="px-2 py-2"
        >
          Your email
        </label>
        <input
          type="text"
          id="contact_email"
          name="contact_email"
          defaultValue={job?.contact_email || ''}
          className="border px-2 py-2"
        />
      </div>
      <div className="grid grid-cols-[25%_75%]">
        <label
          htmlFor="location"
          className="px-2 py-2"
        >
          Where will the job be?
        </label>
        <input
          type="text"
          id="location"
          name="location"
          defaultValue={job?.location || ''}
          className="border px-2 py-2"
        />
      </div>
      <div className="grid grid-cols-[25%_75%]">
        <label
          htmlFor="details"
          className="px-2 py-2"
        >
          What are the job details?
        </label>
        <textarea
          id="details"
          name="details"
          defaultValue={job?.details || ''}
          className="border px-2 py-2 h-24"
        />
      </div>
      <div className="flex justify-end">
        <button
          type="submit"
          className="bg-cyan-400 px-4 py-1 rounded"
        >
          {job ? 'Update' : 'Post'}
        </button>
      </div>
    </form>
  );
};

export default JobForm;
