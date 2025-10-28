import {router} from '@inertiajs/react';
import React from 'react';

const EmailFilter = ({ email }) => {
  const refresh = (e) => {
    router.replace(`/jobs?email=${e.target.value}`);
  };

  return (
    <div className="flex space-x-4 items-center">
      <label htmlFor="email">Filter by email</label>
      <input
        type="text"
        className="border px-2 py-2"
        id="email"
        name="email"
        value={email || ''}
        onChange={refresh}
        autoComplete="off"
      />
    </div>
  );
};

export default EmailFilter;
