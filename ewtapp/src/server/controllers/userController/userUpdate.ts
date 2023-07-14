import { NextFunction, Response } from "express";
import { Request } from "express-jwt";
import createUserToken from "../../utils/auth/createUserToken";
import userUpdatePrisma from "../../utils/db/user/userUpdatePrisma";
import { hashPassword } from "../../utils/hashPassword";
import userViewer from "../../view/userViewer";

/**
 * User controller that updates the current user with info given on the body of
 * the request.
 *
 * @param req Request with authenticated user in the auth property and new 
 *                    information on the body of the request.
 * @param res Response
 * @param next NextFunction
 * @returns
 */
export default async function userUpdate(
  req : Request,
  res : Response,
  next: NextFunction
) {
  // TODO: IMPLEMENT PASSWORD HASHING
  const username = req.auth?.user?.username;
  const info     = req.body.user;

  try {
    // create password hash
    info.password = hashPassword(info.password);

    // Get current user
    const user = await userUpdatePrisma(username, info);
    if ( !user ) return res.sendStatus(404);

    // Create the user token for future authentications
    const token = createUserToken(user);

    // Create the user view with the authneticated token 
    const userView = userViewer(user, token);

    return res.json(userView);
  } catch (error) {
    return next(error);
  }
}

