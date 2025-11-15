import React from 'react';
import { router } from '@inertiajs/react';

const EmailFilter = ({ email = '' }) => {
  const handleChange = (e) => {
    const value = e.target.value;

    router.get(
      '/jobs',
      value ? { email: value } : {}, // if empty, drop the filter
      {
        preserveState: true,
        replace: true,
      },
    );
  };

  return (
    <div className="flex space-x-4 items-center">
      <label htmlFor="email">Filter by email</label>
      <input
        type="text"
        id="email"
        name="email"
        className="border px-2 py-2"
        value={email}
        onChange={handleChange}
        autoComplete="off"
        placeholder="Type an email to filter"
      />
    </div>
  );
};

export default EmailFilter;
