import { render } from '@testing-library/react';
import Create from './Create';
import userEvent from '@testing-library/user-event';
import { router } from '@inertiajs/react';

vi.mock('@inertiajs/react', () => ({
  router: {
    post: vi.fn(),
  },
  Link: ({ children, ...props }) => <a {...props}>{children}</a>,
}));

describe('Jobs/Create', () => {
  it('stores a new job when the form is submitted', async () => {
    const { getByLabelText, getByText } = render(<Create />);

    await userEvent.type(getByLabelText('Your name'), 'Rod');
    await userEvent.type(getByLabelText('Your phone number'), '0400000001');
    await userEvent.type(getByLabelText('Your email'), 'test@user.com.au');
    await userEvent.type(getByLabelText('Where will the job be?'), 'Brisbane');
    await userEvent.type(getByLabelText('What are the job details?'), 'I want to dig a hole.');

    await userEvent.click(getByText('Post'));

    expect(router.post).toHaveBeenCalledWith('/jobs', {
      contact_name: 'Rod',
      contact_phone: '0400000001',
      contact_email: 'test@user.com.au',
      location: 'Brisbane',
      details: 'I want to dig a hole.',
    });
  });
});
